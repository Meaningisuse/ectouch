<?php

/**
 * 管理中心菜单数组
 */

$modules['01_menu_goods']['01_goods_list'] = 'goods.php?act=list';         // 商品列表
$modules['01_menu_goods']['02_goods_add'] = 'goods.php?act=add';          // 添加商品
$modules['01_menu_goods']['03_category_list'] = 'category.php?act=list';
$modules['01_menu_goods']['05_comment_manage'] = 'comment_manage.php?act=list';
$modules['01_menu_goods']['06_goods_brand_list'] = 'brand.php?act=list';
$modules['01_menu_goods']['08_goods_type'] = 'goods_type.php?act=manage';
$modules['01_menu_goods']['11_goods_trash'] = 'goods.php?act=trash';        // 商品回收站
$modules['01_menu_goods']['12_batch_pic'] = 'picture_batch.php';
$modules['01_menu_goods']['13_batch_add'] = 'goods_batch.php?act=add';    // 商品批量上传
$modules['01_menu_goods']['14_goods_export'] = 'goods_export.php?act=goods_export';
$modules['01_menu_goods']['15_batch_edit'] = 'goods_batch.php?act=select'; // 商品批量修改
$modules['01_menu_goods']['16_goods_script'] = 'gen_goods_script.php?act=setup';
$modules['01_menu_goods']['17_tag_manage'] = 'tag_manage.php?act=list';
$modules['01_menu_goods']['50_virtual_card_list'] = 'goods.php?act=list&extension_code=virtual_card';
$modules['01_menu_goods']['51_virtual_card_add'] = 'goods.php?act=add&extension_code=virtual_card';
$modules['01_menu_goods']['52_virtual_card_change'] = 'virtual_card.php?act=change';
$modules['01_menu_goods']['goods_auto'] = 'goods_auto.php?act=list';



$modules['02_menu_order']['02_order_list'] = 'order.php?act=list';
$modules['02_menu_order']['03_order_query'] = 'order.php?act=order_query';
$modules['02_menu_order']['04_merge_order'] = 'order.php?act=merge';
$modules['02_menu_order']['05_edit_order_print'] = 'order.php?act=templates';
$modules['02_menu_order']['06_undispose_booking'] = 'goods_booking.php?act=list_all';
//$modules['02_menu_order']['07_repay_application']        = 'repay.php?act=list_all';
$modules['02_menu_order']['08_add_order'] = 'order.php?act=add';
$modules['02_menu_order']['09_delivery_order'] = 'order.php?act=delivery_list';
$modules['02_menu_order']['10_back_order'] = 'order.php?act=back_list';



$modules['03_menu_members']['03_users_list'] = 'users.php?act=list';
$modules['03_menu_members']['04_users_add'] = 'users.php?act=add';
$modules['03_menu_members']['05_user_rank_list'] = 'user_rank.php?act=list';
$modules['03_menu_members']['06_list_integrate'] = 'integrate.php?act=list';
$modules['03_menu_members']['08_unreply_msg'] = 'user_msg.php?act=list_all';
$modules['03_menu_members']['09_user_account'] = 'user_account.php?act=list';
$modules['03_menu_members']['10_user_account_manage'] = 'user_account_manage.php?act=list';



$modules['04_menu_stats']['flow_stats'] = 'flow_stats.php?act=view';
$modules['04_menu_stats']['searchengine_stats'] = 'searchengine_stats.php?act=view';
$modules['04_menu_stats']['z_clicks_stats'] = 'adsense.php?act=list';
$modules['04_menu_stats']['report_guest'] = 'guest_stats.php?act=list';
$modules['04_menu_stats']['report_order'] = 'order_stats.php?act=list';
$modules['04_menu_stats']['report_sell'] = 'sale_general.php?act=list';
$modules['04_menu_stats']['sale_list'] = 'sale_list.php?act=list';
$modules['04_menu_stats']['sell_stats'] = 'sale_order.php?act=goods_num';
$modules['04_menu_stats']['report_users'] = 'users_order.php?act=order_num';
$modules['04_menu_stats']['visit_buy_per'] = 'visit_sold.php?act=list';



$modules['05_menu_finance']['visit_buy_per'] = 'visit_sold.php?act=list';



$modules['06_menu_promotion']['02_snatch_list'] = 'snatch.php?act=list';
$modules['06_menu_promotion']['04_bonustype_list'] = 'bonus.php?act=list';
$modules['06_menu_promotion']['06_pack_list'] = 'pack.php?act=list';
$modules['06_menu_promotion']['07_card_list'] = 'card.php?act=list';
$modules['06_menu_promotion']['08_group_buy'] = 'group_buy.php?act=list';
$modules['06_menu_promotion']['09_topic'] = 'topic.php?act=list';
$modules['06_menu_promotion']['10_auction'] = 'auction.php?act=list';
$modules['06_menu_promotion']['12_favourable'] = 'favourable.php?act=list';
$modules['06_menu_promotion']['13_wholesale'] = 'wholesale.php?act=list';
$modules['06_menu_promotion']['14_package_list'] = 'package.php?act=list';
//$modules['06_menu_promotion']['ebao_commend']            = 'ebao_commend.php?act=list';
$modules['06_menu_promotion']['15_exchange_goods'] = 'exchange_goods.php?act=list';



$modules['07_menu_shop']['03_article_list'] = 'article.php?act=list';
$modules['07_menu_shop']['02_articlecat_list'] = 'articlecat.php?act=list';
$modules['07_menu_shop']['vote_list'] = 'vote.php?act=list';
$modules['07_menu_shop']['article_auto'] = 'article_auto.php?act=list';
//$modules['07_menu_shop']['shop_help']                 = 'shophelp.php?act=list_cat';
//$modules['07_menu_shop']['shop_info']                 = 'shopinfo.php?act=list';

$modules['07_menu_shop']['02_template_select'] = 'template.php?act=list';
$modules['07_menu_shop']['03_template_setup'] = 'template.php?act=setup';
$modules['07_menu_shop']['04_template_library'] = 'template.php?act=library';
$modules['07_menu_shop']['05_edit_languages'] = 'edit_languages.php?act=list';
$modules['07_menu_shop']['06_template_backup'] = 'template.php?act=backup_setting';
$modules['07_menu_shop']['mail_template_manage'] = 'mail_template.php?act=list';

$modules['07_menu_shop']['ad_position'] = 'ad_position.php?act=list';
$modules['07_menu_shop']['ad_list'] = 'ads.php?act=list';

$modules['07_menu_shop']['affiliate'] = 'affiliate.php?act=list';
$modules['07_menu_shop']['affiliate_ck'] = 'affiliate_ck.php?act=list';

$modules['07_menu_shop']['email_list'] = 'email_list.php?act=list';
$modules['07_menu_shop']['magazine_list'] = 'magazine_list.php?act=list';
$modules['07_menu_shop']['attention_list'] = 'attention_list.php?act=list';
$modules['07_menu_shop']['view_sendlist'] = 'view_sendlist.php?act=list';



$modules['08_menu_system']['01_shop_config'] = 'shop_config.php?act=list_edit';
$modules['08_menu_system']['shop_authorized'] = 'license.php?act=list_edit';
$modules['08_menu_system']['02_payment_list'] = 'payment.php?act=list';
$modules['08_menu_system']['03_shipping_list'] = 'shipping.php?act=list';
$modules['08_menu_system']['04_mail_settings'] = 'shop_config.php?act=mail_settings';
$modules['08_menu_system']['05_area_list'] = 'area_manage.php?act=list';
//$modules['08_menu_system']['06_plugins']                 = 'plugins.php?act=list';
$modules['08_menu_system']['07_cron_schcron'] = 'cron.php?act=list';
$modules['08_menu_system']['08_friendlink_list'] = 'friend_link.php?act=list';
$modules['08_menu_system']['sitemap'] = 'sitemap.php';
$modules['08_menu_system']['check_file_priv'] = 'check_file_priv.php?act=check';
$modules['08_menu_system']['captcha_manage'] = 'captcha_manage.php?act=main';
$modules['08_menu_system']['ucenter_setup'] = 'integrate.php?act=setup&code=ucenter';
$modules['08_menu_system']['flashplay'] = 'flashplay.php?act=list';
$modules['08_menu_system']['navigator'] = 'navigator.php?act=list';
$modules['08_menu_system']['file_check'] = 'filecheck.php';
//$modules['08_menu_system']['fckfile_manage']             = 'fckfile_manage.php?act=list';
$modules['08_menu_system']['021_reg_fields'] = 'reg_fields.php?act=list';

$modules['08_menu_system']['admin_logs'] = 'admin_logs.php?act=list';
$modules['08_menu_system']['admin_list'] = 'privilege.php?act=list';
$modules['08_menu_system']['admin_role'] = 'role.php?act=list';
$modules['08_menu_system']['agency_list'] = 'agency.php?act=list';
$modules['08_menu_system']['suppliers_list'] = 'suppliers.php?act=list'; // 供货商

$modules['08_menu_system']['02_db_manage'] = 'database.php?act=backup';
$modules['08_menu_system']['03_db_optimize'] = 'database.php?act=optimize';
$modules['08_menu_system']['04_sql_query'] = 'sql.php?act=main';
//$modules['08_menu_system']['05_synchronous']             = 'integrate.php?act=sync';
$modules['08_menu_system']['convert'] = 'convert.php?act=main';


//$modules['08_menu_system']['02_sms_my_info']                = 'sms.php?act=display_my_info';
$modules['08_menu_system']['03_sms_send'] = 'sms.php?act=display_send_ui';
$modules['08_menu_system']['04_sms_sign'] = 'sms.php?act=sms_sign';
//$modules['08_menu_system']['04_sms_charge']                 = 'sms.php?act=display_charge_ui';
//$modules['08_menu_system']['05_sms_send_history']           = 'sms.php?act=display_send_history_ui';
//$modules['08_menu_system']['06_sms_charge_history']         = 'sms.php?act=display_charge_history_ui';


return $modules;