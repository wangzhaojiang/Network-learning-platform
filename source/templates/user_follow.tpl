<{include file="header.tpl"}>
<section class="page-wrapper">
    <section class="center-grid clearfix">
        <aside>
            <div class="profile-wrapper">
                <div class="profile-info clearfix">
                    <div class="avatar pull-left">
                        <a href="#">
                            <img src="<{$site_domain}>/images/demo/avatar.png"/>
                        </a>
                    </div>
                    <div class="username"><a href="#">Jensyn</a></div>
                    <div class="rank">普通会员</div>
                </div>
                <a href="#" class="btn btn-block btn-green btn-upgrade">升级</a>
            </div>
            <div class="aside-navigation">
                <section class="activity">
                    <h4 class="activity-title">动态</h4>
                    <ul class="activity-list">
                        <li class="active">
                            <a href="#">我的课程</a>
                        </li>
                        <li>
                            <a href="#">关注的人</a>
                        </li>
                    </ul>
                </section>
                <section class="activity">
                    <h4 class="activity-title">动态</h4>
                    <ul class="activity-list">
                        <li class="active">
                            <a href="#">我的课程</a>
                        </li>
                        <li>
                            <a href="#">关注的人</a>
                        </li>
                    </ul>
                </section>
                <a href="#" class="video-preview aside-video-preview">
                    <div class="video-thumbnail"></div>
                </a>
            </div>
        </aside>
        <section class="page-content">
            <section class="page-content-nav">
                <ul>
                    <li class="active"><a href="#">关注</a></li>
                    <li><a href="<{$site_domain}>/relation_fans.php">粉丝</a></li>
                </ul>
            </section>
            <section class="followed-page">
                <div class="user-relation-number">
				<{if count($user_follow) neq 0}>
                    <a class="followed-n">
                        我关注了 <{count($user_follow)}> 人
                    </a>
				<{else}>
					<a class="followed-n">
						我还没有关注任何人
					</a>
				<{/if}>
                </div>
                <div class="user-relation-info">
				<{section name = n loop = $user_follow }>
					<div class="user-relation-page-info  clearfix">
                        <div  class="user-relation-button">
							<{if $user_follow[n].relation == 0}>
                            <input data="<{$user_follow[n].uid}>" type="button" value="取消关注" class=" btn-green relat-btn" />
							<{else}>
                            <input data="<{$user_follow[n].uid}>" type="button" value="相互关注" class=" btn-green relat-btn" />
							<{/if}>
                        </div>
                        <div class="user-relation-logo-display">
                            <a href="#">
                                <img src="<{$user_follow[n].logo}>">
                            </a>
                        </div>
                        <div class="user-relation-header">
                            <a href="#"><{$user_follow[n].name}></a>
                            <div class="user-relation-body">
                                <{$user_follow[n].school}>
                            </div>
                            <div class="user-sign">
								<{$user_follow[n].sign}>
							</div>
                        </div>
                    </div>
		        <{/section}>
                </div>
            </section>
        </section>
    </section>
</section>
<footer>
    <ul class="link-list clearfix">
        <li>@接课网</li>
        <li><a href="#">关于</a></li>
        <li><a href="#">团队</a></li>
        <li><a href="#">博客</a></li>
    </ul>
</footer>
</body>
<script type="text/javascript" src="<{$site_domain}>/js/jquery.js"></script>
<script type="text/javascript" src="<{$site_domain}>/plugins/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript" src="<{$site_domain}>/plugins/jQueryFullPage/js/jquery.fullPage.min.js"></script>

<!--init page events-->
<script type="text/javascript" src="<{$site_domain}>/js/app-init.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('.relat-btn').click(function() {
            var status=$(this).val();
			var obj = $(this);
            if (status == "取消关注" || status == "相互关注") {
				var param = {
					action: 'delete_relation',
					uid: $(this).attr("data")
				};
				$.post('<{$site_domain}>/server/relation.server.php', param, function(data){
					var messageitem = JSON.parse(data);
					if (messageitem.status == true) {
						obj.val("关注");
						return ;
					} else if (messageitem.status == false){
						obj.val("取消关注");
						return ;
					}
				});
			} else if (status == "关注"){
				var param = {
					action: 'add_relation',
					uid: $(this).attr("data")
				};
				$.post('<{$site_domain}>/server/relation.server.php', param, function(data){
					var messageitem = JSON.parse(data);
					if (messageitem.status == true) {
						obj.val("取消关注");
						return ;
					} else if (messageitem.status == false){
						obj.val("关注");
						return ;
					}
				});
            }
        });
    });
</script>
</html>
