<?php
//The article reading quantity statistics
function kratos_set_post_views(){
    if(is_singular()){
      global $post;
      $post_ID = $post->ID;
      if($post_ID){
          $post_views = (int)get_post_meta($post_ID,'views',true);
          if(!update_post_meta($post_ID,'views',($post_views+1))) add_post_meta($post_ID,'views',1,true);
      }
    }
}
add_action('wp_head','kratos_set_post_views');
function num2tring($num){
    if($num>=1000) $num = round($num/1000*100)/100 .'k';
    return $num;
}
function kratos_get_post_views($before='',$after='',$echo=1){
  global $post;
  $post_ID = $post->ID;
  $views = (int)get_post_meta($post_ID,'views',true);
  return num2tring($views);
}
//Appreciate the article
function kratos_love(){
    global $wpdb,$post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if($action=='love'){
        $raters = get_post_meta($id,'love',true);
        $expire = time()+99999999;
        $domain = ($_SERVER['HTTP_HOST']!='localhost')?$_SERVER['HTTP_HOST']:false;
        setcookie('love_'.$id,$id,$expire,'/',$domain,false);
        if(!$raters||!is_numeric($raters)){
            update_post_meta($id,'love',1);
        }else{
            update_post_meta($id,'love',($raters+1));
        }
        echo get_post_meta($id,'love',true);
    }
    die;
}
add_action('wp_ajax_nopriv_love','kratos_love');
add_action('wp_ajax_love','kratos_love');
//Post title optimization
add_filter('private_title_format','kratos_private_title_format' );
add_filter('protected_title_format','kratos_private_title_format' );
function kratos_private_title_format($format){return '%s';}
//Password protection articles
add_filter('the_password_form','custom_password_form');
function custom_password_form(){
    $url = wp_login_url();
    global $post;$label='pwbox-'.(empty($post->ID)?rand():$post->ID);$o='
    <form class="protected-post-form" action="'.$url.'?action=postpass" method="post">
        <div class="panel panel-pwd">
            <div class="panel-body text-center">
                <img class="post-pwd" src="'.get_template_directory_uri().'/static/images/fingerprint.png"><br />
                <h4>'.__('这是一篇受保护的文章，请输入阅读密码！','moedog').'</h4>
                <div class="input-group" id="respond">
                    <div class="input-group-addon"><i class="fa fa-key"></i></div>
                    <p><input class="form-control" placeholder="'.__('输入阅读密码','moedog').'" name="post_password" id="'.$label.'" type="password" size="20"></p>
                </div>
                <div class="comment-form" style="margin-top:15px;"><button id="generate" class="btn btn-primary btn-pwd" name="Submit" type="submit">'.__('确认','moedog').'</button></div>
            </div>
        </div>
    </form>';
return $o;
}
//Comments face
add_filter('smilies_src','custom_smilies_src',1,10);
function custom_smilies_src($img_src,$img,$siteurl){
    return get_bloginfo('template_directory').'/static/images/smilies/'.$img;
}
function smilies_reset(){
    global $wpsmiliestrans,$wp_smiliessearch,$wp_version;
    if(!get_option('use_smilies')||$wp_version<4.2) return;
    $wpsmiliestrans = array(
        ':badwater:' => 'badwater.jpg',
        ':bailan:' => 'bailan.jpg',
        ':bxianghuole:' => 'bxianghuole.jpg',
        ':cao:' => 'cao.jpg',
        ':chidao:' => 'chidao.jpg',
        ':chifanle:' => 'chifanle.jpg',
        ':chigua:' => 'chigua.jpg',
        ':chonglang:' => 'chonglang.jpg',
        ':ciji:' => 'ciji.jpg',
        ':dashengku:' => 'dashengku.jpg',
        ':emmm:' => 'emmm.jpg',
        ':fanleni:' => 'fanleni.jpg',
        ':fuxi:' => 'fuxi.jpg',
        ':guaihaodeli:' => 'guaihaodeli.jpg',
        ':hahaha:' => 'hahaha.jpg',
        ':han:' => 'han.jpg',
        ':ohoh:' => 'ohoh.jpg',
        ':huahua:' => 'huahua.jpg',
        ':jiamian:' => 'jiamian.jpg',
        ':jing:' => 'jing.jpg',
        ':jinzhang:' => 'jinzhang.jpg',
        ':juan:' => 'juan.jpg',
        ':juliusha:' => 'juliusha.jpg',
        ':kankan:' => 'kankan.jpg',
        ':keshui:' => 'keshui.jpg',
        ':kugua:' => 'kugua.jpg',
        ':meishiba:' => 'meishiba.jpg',
        ':menglong:' => 'menglong.jpg',
        ':messageing:' => 'messageing.jpg',
        ':mingku:' => 'mingku.jpg',
        ':paolu:' => 'paolu.jpg',
        ':pig:' => 'pig.jpg',
        ':qianshui:' => 'qianshui.jpg',
        ':shaque:' => 'shaque.jpg',
        ':shaxin:' => 'shaxin.jpg',
        ':shengqi:' => 'shengqi.jpg',
        ':shufu:' => 'shufu.jpg',
        ':shuijiaole:' => 'shuijiaole.jpg',
        ':sile:' => 'sile.jpg',
        ':tanqi:' => 'tanqi.jpg',
        ':tule:' => 'tule.jpg',
        ':wa:' => 'wa.jpg',
        ':wuyi:' => 'wuyi.jpg',
        ':wuyu:' => 'wuyu.jpg',
        ':xiexienij:' => 'xiexienij.jpg',
        ':fanzao:' => 'fanzao.jpg',
        ':yiwen:' => 'yiwen.jpg',
        ':zao:' => 'zao.jpg',
        ':zeze:' => 'zeze.jpg',
        ':zhuhe:' => 'zhuhe.jpg',
        ':zuibang:' => 'zuibang.jpg',
        ':bukuishiwo:' => 'bukuishiwo.jpg',
        ':bushengqi:' => 'bushengqi.jpg',
        ':dalian:' => 'dalian.jpg',
        ':dingguagua:' => 'dingguagua.jpg',
        ':ku:' => 'ku.jpg',
        ':liulei:' => 'liulei.jpg',
        ':luelue:' => 'luelue.jpg',
        ':moyu:' => 'moyu.jpg',
        ':qidai:' => 'qidai.jpg',
        ':sese:' => 'sese.jpg',
        ':shagua:' => 'shagua.jpg',
        ':shaquan:' => 'shaquan.jpg',
        ':shuang:' => 'shuang.jpg',
        ':shuile:' => 'shuile.jpg',
        ':xiangkaile:' => 'xiangkaile.jpg',
        ':xianhua:' => 'xianhua.jpg',
        ':xuegao:' => 'xuegao.jpg',
        ':ye:' => 'ye.jpg',
        ':zan:' => 'zan.jpg',   
        ':ansha:' => 'ansha.jpg',
        ':badlunck:' => 'badlunck.jpg',
        ':bieshengqi:' => 'bieshengqi.jpg',
        ':dingguagua:' => 'dingguagua.jpg',
        ':bujige:' => 'bujige.jpg',
        ':canhui:' => 'canhui.jpg',
        ':changge:' => 'changge.jpg',
        ':chitu:' => 'chitu.jpg',
        ':crying:' => 'crying.jpg',
        ':cuoguo:' => 'cuoguo.jpg',
        ':dataosha:' => 'dataosha.jpg',
        ':eating:' => 'eating.jpg',
        ':fangjia:' => 'fangjia.jpg',
        ':guayu:' => 'guayu.jpg',
        ':happyguy:' => 'happyguy.jpg',
        ':hehao:' => 'hehao.jpg',
        ':hehaoba:' => 'hehaoba.jpg',
        ':huanxiang:' => 'huanxiang.jpg',
        ':huole:' => 'huole.jpg',
        ':imagining:' => 'imagining.jpg',
        ':jiaji:' => 'jiaji.jpg',
        ':juliu:' => 'juliu.jpg',
        ':kaiqiang:' => 'kaiqiang.jpg',
        ':kuaipao:' => 'kuaipao.jpg',
        ':kuangnu:' => 'kuangnu.jpg',
        ':listening:' => 'listening.jpg',
        ':nidaye:' => 'nidaye.jpg',
        ':nizi:' => 'nizi.jpg',
        ':noowork:' => 'noowork.jpg',
        ':panni:' => 'panni.jpg',
        ':playing:' => 'playing.jpg',
        ':power:' => 'power.jpg',
        ':qionggui:' => 'qionggui.jpg',
        ':redaofakuang:' => 'redaofakuang.jpg',
        ':rehuale:' => 'rehuale.jpg',
        ':ren:' => 'ren.jpg',
        ':shaa:' => 'shaa.jpg',  
        ':youshaa:' => 'youshaa.jpg',
        ':shadiao:' => 'shadiao.jpg',
        ':huole:' => 'huole.jpg',
        ':shafengle:' => 'shafengle.jpg',
        ':shagou:' => 'shagou.jpg',
        ':shamate:' => 'shamate.jpg',
        ':shashou:' => 'shashou.jpg',
        ':shenghuo:' => 'shenghuo.jpg',
        ':shengqile:' => 'shengqile.jpg',
        ':shiyi:' => 'shiyi.jpg',
        ':shouchang:' => 'shouchang.jpg',
        ':shuai:' => 'shuai.jpg',
        ':sleeping:' => 'sleeping.jpg',
        ':taijie:' => 'taijie.jpg',
        ':tian:' => 'tian.jpg',
        ':tiaopi:' => 'tiaopi.jpg',
        ':toudale:' => 'toudale.jpg',
        ':tudou:' => 'tudou.jpg',
        ':tuili:' => 'tuili.jpg',
        ':v50:' => 'v50.jpg',
        ':xiaolaodi:' => 'xiaolaodi.jpg',
        ':xiaoxs:' => 'xiaoxs.jpg',
        ':xinjingziranliang:' => 'xinjingziranliang.jpg',
        ':yangni:' => 'yangni.jpg',
        ':yourfather:' => 'yourfather.jpg',
        ':zaixuele:' => 'zaixuele.jpg',
        ':zhuangbi:' => 'zhuangbi.jpg',
        ':zisha:' => 'zisha.jpg',  
        ':hehework:' => 'hehework.jpg',
        ':keliansha:' => 'keliansha.jpg',
        ':leidianle:' => 'leidianle.jpg',
        ':lovework:' => 'lovework.jpg',
        ':xiabanle:' => 'xiabanle.jpg',
        ':yiqianba:' => 'yiqianba.jpg',   
        ':chou:' => 'chou.jpg',
        ':chouku:' => 'chouku.jpg',
        ':danshen:' => 'danshen.jpg',
        ':hunsha:' => 'hunsha.jpg',
        ':shabi:' => 'shabi.jpg',
        ':mengsha:' => 'mengsha.jpg',
        ':mengsha1:' => 'mengsha1.jpg',
        ':mengsha2:' => 'mengsha2.jpg',
        ':haosao:' => 'haosao.jpg',
        ':pinru:' => 'pinru.jpg',
        ':shabi1:' => 'shabi1.jpg',
        ':shabi10:' => 'shabi10.jpg',
        ':shabi50:' => 'shabi50.jpg',
        ':shabi100:' => 'shabi100.jpg',
        ':mon:' => 'mon.jpg',
        ':Tue:' => 'Tue.jpg',
        ':Wed:' => 'Wed.jpg',
        ':Thu:' => 'Thu.jpg',
        ':Fri:' => 'Fri.jpg',
        ':sat:' => 'sat.jpg',
        ':Sun:' => 'Sun.jpg',
   
    );
}
smilies_reset();
//Paging
function kratos_pages($range=5){
    global $paged,$wp_query,$max_page;
    if(!$max_page){$max_page=$wp_query->max_num_pages;}
    if($max_page>1){if(!$paged){$paged=1;}
    echo "<div class='text-center' id='page-footer'><ul class='pagination'>";
        if($paged != 1) echo '<li><a href="'.get_pagenum_link(1).'" class="extend" title="'.__('首页','moedog').'">&laquo;</a></li>';
        if($paged>1) echo '<li><a href="'.get_pagenum_link($paged-1).'" class="prev" title="'.__('上一页','moedog').'">&lt;</a></li>';
        if($max_page>$range){
            if($paged<$range){
                for($i=1;$i<=($range+1);$i++){
                    echo "<li";
                    if($i==$paged) echo " class='active'";
                    echo "><a href='".get_pagenum_link($i)."'>$i</a></li>";
                }
            }
            elseif($paged>=($max_page-ceil(($range/2)))){
                for($i=$max_page-$range;$i<=$max_page;$i++){
                    echo "<li";
                    if($i==$paged) echo " class='active'";echo "><a href='".get_pagenum_link($i)."'>$i</a></li>";
                }
            }
            elseif($paged>=$range&&$paged<($max_page-ceil(($range/2)))){
                for($i=($paged-ceil($range/2));$i<=($paged+ceil(($range/2)));$i++){
                    echo "<li";
                    if($i==$paged) echo " class='active'";
                    echo "><a href='".get_pagenum_link($i)."'>$i</a></li>";
                }
            }
        }else{
            for($i=1;$i<=$max_page;$i++){
                echo "<li";
                if($i==$paged) echo " class='active'";
                echo "><a href='".get_pagenum_link($i)."'>$i</a></li>";
            }
        }
        if($paged<$max_page) echo '<li><a href="'.get_pagenum_link($paged+1).'" class="next" title="'.__('下一页','moedog').'">&gt;</a></li>';
        if($paged!=$max_page) echo '<li><a href="'.get_pagenum_link($max_page).'" class="extend" title="'.__('尾页','moedog').'">&raquo;</a></li>';
        echo "</ul></div>";
    }
}