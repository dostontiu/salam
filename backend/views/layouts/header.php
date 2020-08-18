<?php

use backend\assets\AdminAsset;
use yii\helpers\Html;

AdminAsset::register($this);

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
        <script>
            WebFont.load({
                google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
                active: function() {
                    sessionStorage.fonts = true;
                }
            });
        </script>
    </head>
    <body class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
    <?php $this->beginBody() ?>
    <!-- begin:: Page -->

    <!-- begin:: Header Mobile -->
    <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
        <div class="kt-header-mobile__logo">
            <a href="<?= Yii::$app->homeUrl?>">
                <img alt="Logo" src="<?= Yii::$app->homeUrl?>admin/media/logos/logo-light1.png" />
            </a>
        </div>
        <div class="kt-header-mobile__toolbar">
            <button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
            <button class="kt-header-mobile__toggler" id="kt_header_mobile_toggler"><span></span></button>
            <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
        </div>
    </div>

    <!-- end:: Header Mobile -->
    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

            <!-- begin:: Aside -->
            <button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
            <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

                <!-- begin:: Aside -->
                <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
                    <div class="kt-aside__brand-logo">
                        <a href="<?= Yii::$app->homeUrl?>">
                            <img alt="Logo" src="<?= Yii::$app->homeUrl?>admin/media/logos/logo-light1.png" />
                        </a>
                    </div>
                    <div class="kt-aside__brand-tools">
                        <button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
								<span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<polygon id="Shape" points="0 0 24 0 24 24 0 24" />
											<path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" id="Path-94" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) " />
											<path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" id="Path-94" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) " />
										</g>
									</svg></span>
                            <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<polygon id="Shape" points="0 0 24 0 24 24 0 24" />
											<path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" id="Path-94" fill="#000000" fill-rule="nonzero" />
											<path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" id="Path-94" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) " />
										</g>
									</svg></span>
                        </button>

                        <!--
        <button class="kt-aside__brand-aside-toggler kt-aside__brand-aside-toggler--left" id="kt_aside_toggler"><span></span></button>
        -->
                    </div>
                </div>

                <!-- end:: Aside -->

                <!-- begin:: Aside Menu -->
                <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
                    <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
                        <ul class="kt-menu__nav ">
                            <li class="kt-menu__item <?=(Yii::$app->controller->id=='site')?'kt-menu__item--active':''?>" aria-haspopup="true"><a href="<?= Yii::$app->homeUrl?>" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-home"></i><span class="kt-menu__link-text">Главная</span></a></li>
                            <li class="kt-menu__item <?=(Yii::$app->controller->id=='profile')?'kt-menu__item--active':''?>" aria-haspopup="true"><a href="<?= Yii::$app->homeUrl?>profile/show" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-user"></i><span class="kt-menu__link-text">Мой профиль</span></a></li>
                            <?php if (Yii::$app->user->can('userAccess')){ ?>
                                <li class="kt-menu__section ">
                                    <h4 class="kt-menu__section-text">Пользователи</h4>
                                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                                </li>
                                <li class="kt-menu__item  kt-menu__item--submenu <?=(Yii::$app->controller->module->id=='rbac')?'kt-menu__item--open kt-menu__item--here':''?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon fa fa-user-cog"></i><span class="kt-menu__link-text">Пользователи</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item <?=(Yii::$app->controller->id=='assignment')?'kt-menu__item--active':''?>" aria-haspopup="true"><a href="<?= Yii::$app->homeUrl?>rbac/assignment" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-user-shield"></i><span class="kt-menu__link-text">Назначения</span></a></li>
                                        <li class="kt-menu__item <?=(Yii::$app->controller->id=='role')?'kt-menu__item--active':''?>" aria-haspopup="true"><a href="<?= Yii::$app->homeUrl?>rbac/role" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-user-secret"></i><span class="kt-menu__link-text">Роли</span></a></li>
                                        <li class="kt-menu__item <?=(Yii::$app->controller->id=='permission')?'kt-menu__item--active':''?>" aria-haspopup="true"><a href="<?= Yii::$app->homeUrl?>rbac/permission" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-user-tag"></i><span class="kt-menu__link-text">Разрешения</span></a></li>
                                        <li class="kt-menu__item <?=(Yii::$app->controller->id=='route')?'kt-menu__item--active':''?>" aria-haspopup="true"><a href="<?= Yii::$app->homeUrl?>rbac/route" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-transgender-alt"></i><span class="kt-menu__link-text">Маршруты</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <?php }?>
                            <li class="kt-menu__section ">
                                <h4 class="kt-menu__section-text">Компоненты</h4>
                                <i class="kt-menu__section-icon flaticon-more-v2"></i>
                            </li>

                            <li class="kt-menu__item  kt-menu__item--submenu <?=(Yii::$app->controller->id=='organization')?'kt-menu__item--open kt-menu__item--here':''?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon fa fa-archway"></i><span class="kt-menu__link-text">Организация</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item <?=($this->context->route=='organization/index')?'kt-menu__item--active':''?>" aria-haspopup="true"><a href="<?= Yii::$app->homeUrl?>organization/index" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-list"></i><span class="kt-menu__link-text">Все организации</span></a></li>
                                        <li class="kt-menu__item <?=($this->context->route=='organization/create')?'kt-menu__item--active':''?>" aria-haspopup="true"><a href="<?= Yii::$app->homeUrl?>organization/create" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-plus-1"></i><span class="kt-menu__link-text">Добавить</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu <?=(Yii::$app->controller->id=='category')?'kt-menu__item--open kt-menu__item--here':''?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon fa fa-clone"></i><span class="kt-menu__link-text">Категория</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item <?=($this->context->route=='category/index')?'kt-menu__item--active':''?>" aria-haspopup="true"><a href="<?= Yii::$app->homeUrl?>category/index" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-list"></i><span class="kt-menu__link-text">Все категори</span></a></li>
                                        <li class="kt-menu__item <?=($this->context->route=='category/create')?'kt-menu__item--active':''?>" aria-haspopup="true"><a href="<?= Yii::$app->homeUrl?>category/create" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-plus-1"></i><span class="kt-menu__link-text">Добавить</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu <?=(Yii::$app->controller->id=='region')?'kt-menu__item--open kt-menu__item--here':''?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon fa fa-city"></i><span class="kt-menu__link-text">Область</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item <?=($this->context->route=='region/index')?'kt-menu__item--active':''?>" aria-haspopup="true"><a href="<?= Yii::$app->homeUrl?>region/index" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-list"></i><span class="kt-menu__link-text">Все области</span></a></li>
                                        <li class="kt-menu__item <?=($this->context->route=='region/create')?'kt-menu__item--active':''?>" aria-haspopup="true"><a href="<?= Yii::$app->homeUrl?>region/create" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-plus-1"></i><span class="kt-menu__link-text">Добавить</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu <?=(Yii::$app->controller->id=='org-comment')?'kt-menu__item--open kt-menu__item--here':''?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon fa fa-city"></i><span class="kt-menu__link-text">Комментарии</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item <?=($this->context->route=='org-comment/index')?'kt-menu__item--active':''?>" aria-haspopup="true"><a href="<?= Yii::$app->homeUrl?>org-comment/index" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-list"></i><span class="kt-menu__link-text">Все комментарии</span></a></li>
                                        <li class="kt-menu__item <?=($this->context->route=='org-comment/create')?'kt-menu__item--active':''?>" aria-haspopup="true"><a href="<?= Yii::$app->homeUrl?>org-comment/create" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-plus-1"></i><span class="kt-menu__link-text">Добавить</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu <?=(Yii::$app->controller->id=='filter')?'kt-menu__item--open kt-menu__item--here':''?>" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon fa fa-address-card"></i><span class="kt-menu__link-text">Филтери</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item <?=($this->context->route=='filter/index')?'kt-menu__item--active':''?>" aria-haspopup="true"><a href="<?= Yii::$app->homeUrl?>filter/index" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-list"></i><span class="kt-menu__link-text">Все филтери</span></a></li>
                                        <li class="kt-menu__item <?=($this->context->route=='filter/create')?'kt-menu__item--active':''?>" aria-haspopup="true"><a href="<?= Yii::$app->homeUrl?>filter/create" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-plus-1"></i><span class="kt-menu__link-text">Добавить</span></a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- end:: Aside Menu -->
            </div>

            <!-- end:: Aside -->
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

                <!-- begin:: Header -->
                <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">
                    <div class="kt-header__topbar"></div>
                    <h2 class="p-4 mr-lg-5">
                        <?php if (isset($this->blocks['content-header'])) { ?>
                            <?= $this->blocks['content-header'] ?>
                        <?php } else { ?>
                            <?php
                            if ($this->title !== null) {
                                echo \yii\helpers\Html::encode($this->title);
                            } else {
                                echo \yii\helpers\Inflector::camel2words(
                                    \yii\helpers\Inflector::id2camel($this->context->module->id)
                                );
                                echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                            } ?>
                        <?php } ?>
                    </h2>
                    <div class="pull-right">
                        <?= Html::a(
                            'Выйти',
                            ['/site/logout'],
                            ['data-method' => 'post', 'class' => 'btn btn-default btn-flat mt-3 mr-4']
                        ) ?>
                    </div>


                </div>

                <!-- end:: Header -->
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
                    <!-- begin:: Content -->
                    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
<!--                        // display success message-->
                        <?php if( Yii::$app->session->hasFlash('success') ): ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo Yii::$app->session->getFlash('success'); ?>
                            </div>
                        <?php endif;?>

<!--                        // display error message-->
                        <?php if( Yii::$app->session->hasFlash('error') ): ?>
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo Yii::$app->session->getFlash('error'); ?>
                            </div>
                        <?php endif;?>
                        <?= $content ?>
                    </div>

                    <!-- end:: Content -->
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Page -->

    <!-- begin::Scrolltop -->
    <div id="kt_scrolltop" class="kt-scrolltop">
        <i class="fa fa-arrow-up"></i>
    </div>

    <!-- end::Scrolltop -->

    <?php $this->endBody() ?>
    </body>
    </html>
    <script>
        var KTAppOptions = {
            "colors": {
                "state": {
                    "brand": "#5d78ff",
                    "dark": "#282a3c",
                    "light": "#ffffff",
                    "primary": "#5867dd",
                    "success": "#34bfa3",
                    "info": "#36a3f7",
                    "warning": "#ffb822",
                    "danger": "#fd3995"
                },
                "base": {
                    "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                    "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                }
            }
        };
    </script>
<?php $this->endPage() ?>