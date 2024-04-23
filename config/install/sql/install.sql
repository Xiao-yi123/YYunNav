/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50727
Source Host           : localhost:3306
Source Database       : easyadmin

Target Server Type    : MYSQL
Target Server Version : 50727
File Encoding         : 65001

Date: 2020-05-17 23:24:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ea_system_admin
-- ----------------------------
DROP TABLE IF EXISTS `ea_system_admin`;
CREATE TABLE `ea_system_admin` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `auth_ids` varchar(255) DEFAULT NULL COMMENT '角色权限ID',
  `head_img` varchar(255) DEFAULT NULL COMMENT '头像',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户登录名',
  `password` char(40) NOT NULL DEFAULT '' COMMENT '用户登录密码',
  `phone` varchar(16) DEFAULT NULL COMMENT '联系手机号',
  `remark` varchar(255) DEFAULT '' COMMENT '备注说明',
  `login_num` bigint(20) unsigned DEFAULT '0' COMMENT '登录次数',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态(0:禁用,1:启用,)',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE,
  KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统用户表';

-- ----------------------------
-- Records of ea_system_admin
-- ----------------------------
INSERT INTO `ea_system_admin` VALUES ('1', null, '/static/admin/images/head.jpg', 'admin', 'a33b679d5581a8692988ec9f92ad2d6a2259eaa7', 'admin', 'admin', '0', '0', '1', '1589454169', '1589476815', null);

-- ----------------------------
-- Table structure for ea_system_auth
-- ----------------------------
DROP TABLE IF EXISTS `ea_system_auth`;
CREATE TABLE `ea_system_auth` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL COMMENT '权限名称',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态(1:禁用,2:启用)',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注说明',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统权限表';

-- ----------------------------
-- Records of ea_system_auth
-- ----------------------------
INSERT INTO `ea_system_auth` VALUES ('1', '管理员', '1', '1', '测试管理员', '1588921753', '1589614331', null);
INSERT INTO `ea_system_auth` VALUES ('6', '游客权限', '0', '1', '', '1588227513', '1589591751', '1589591751');

-- ----------------------------
-- Table structure for ea_system_auth_node
-- ----------------------------
DROP TABLE IF EXISTS `ea_system_auth_node`;
CREATE TABLE `ea_system_auth_node` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `auth_id` bigint(20) unsigned DEFAULT NULL COMMENT '角色ID',
  `node_id` bigint(20) DEFAULT NULL COMMENT '节点ID',
  PRIMARY KEY (`id`),
  KEY `index_system_auth_auth` (`auth_id`) USING BTREE,
  KEY `index_system_auth_node` (`node_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='角色与节点关系表';

-- ----------------------------
-- Records of ea_system_auth_node
-- ----------------------------
INSERT INTO `ea_system_auth_node` VALUES ('1', '6', '1');
INSERT INTO `ea_system_auth_node` VALUES ('2', '6', '2');
INSERT INTO `ea_system_auth_node` VALUES ('3', '6', '9');
INSERT INTO `ea_system_auth_node` VALUES ('4', '6', '12');
INSERT INTO `ea_system_auth_node` VALUES ('5', '6', '18');
INSERT INTO `ea_system_auth_node` VALUES ('6', '6', '19');
INSERT INTO `ea_system_auth_node` VALUES ('7', '6', '21');
INSERT INTO `ea_system_auth_node` VALUES ('8', '6', '22');
INSERT INTO `ea_system_auth_node` VALUES ('9', '6', '29');
INSERT INTO `ea_system_auth_node` VALUES ('10', '6', '30');
INSERT INTO `ea_system_auth_node` VALUES ('11', '6', '38');
INSERT INTO `ea_system_auth_node` VALUES ('12', '6', '39');
INSERT INTO `ea_system_auth_node` VALUES ('13', '6', '45');
INSERT INTO `ea_system_auth_node` VALUES ('14', '6', '46');
INSERT INTO `ea_system_auth_node` VALUES ('15', '6', '52');
INSERT INTO `ea_system_auth_node` VALUES ('16', '6', '53');

-- ----------------------------
-- Table structure for ea_system_config
-- ----------------------------
DROP TABLE IF EXISTS `ea_system_config`;
CREATE TABLE `ea_system_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '变量名',
  `group` varchar(30) NOT NULL DEFAULT '' COMMENT '分组',
  `value` text COMMENT '变量值',
  `remark` varchar(100) DEFAULT '' COMMENT '备注信息',
  `sort` int(10) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `group` (`group`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统配置表';

-- ----------------------------
-- Records of ea_system_config
-- ----------------------------
INSERT INTO `ea_system_config` VALUES ('41', 'alisms_access_key_id', 'sms', '填你的', '阿里大于公钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('42', 'alisms_access_key_secret', 'sms', '填你的', '阿里大鱼私钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('55', 'upload_type', 'upload', 'local', '当前上传方式 （local,alioss,qnoss,txoss）', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('56', 'upload_allow_ext', 'upload', 'doc,gif,ico,icon,jpg,mp3,mp4,p12,pem,png,rar,jpeg', '允许上传的文件类型', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('57', 'upload_allow_size', 'upload', '1024000', '允许上传的大小', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('58', 'upload_allow_mime', 'upload', 'image/gif,image/jpeg,video/x-msvideo,text/plain,image/png', '允许上传的文件mime', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('59', 'upload_allow_type', 'upload', 'local,alioss,qnoss,txcos', '可用的上传文件方式', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('60', 'alioss_access_key_id', 'upload', '填你的', '阿里云oss公钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('61', 'alioss_access_key_secret', 'upload', '填你的', '阿里云oss私钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('62', 'alioss_endpoint', 'upload', '填你的', '阿里云oss数据中心', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('63', 'alioss_bucket', 'upload', '填你的', '阿里云oss空间名称', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('64', 'alioss_domain', 'upload', '填你的', '阿里云oss访问域名', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('65', 'logo_title', 'site', 'EasyAdmin', 'LOGO标题', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('66', 'logo_image', 'site', '/favicon.ico', 'logo图片', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('68', 'site_name', 'site', 'EasyAdmin后台系统', '站点名称', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('69', 'site_ico', 'site', '填你的', '浏览器图标', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('70', 'site_copyright', 'site', '填你的', '版权信息', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('71', 'site_beian', 'site', '填你的', '备案信息', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('72', 'site_version', 'site', '2.0.0', '版本信息', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('75', 'sms_type', 'sms', 'alisms', '短信类型', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('76', 'miniapp_appid', 'wechat', '填你的', '小程序公钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('77', 'miniapp_appsecret', 'wechat', '填你的', '小程序私钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('78', 'web_appid', 'wechat', '填你的', '公众号公钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('79', 'web_appsecret', 'wechat', '填你的', '公众号私钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('80', 'txcos_secret_id', 'upload', '填你的', '腾讯云cos密钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('81', 'txcos_secret_key', 'upload', '填你的', '腾讯云cos私钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('82', 'txcos_region', 'upload', '填你的', '存储桶地域', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('83', 'tecos_bucket', 'upload', '填你的', '存储桶名称', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('84', 'qnoss_access_key', 'upload', '填你的', '访问密钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('85', 'qnoss_secret_key', 'upload', '填你的', '安全密钥', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('86', 'qnoss_bucket', 'upload', '填你的', '存储空间', '0', null, null);
INSERT INTO `ea_system_config` VALUES ('87', 'qnoss_domain', 'upload', '填你的', '访问域名', '0', null, null);

-- ----------------------------
-- Table structure for ea_system_menu
-- ----------------------------
DROP TABLE IF EXISTS `ea_system_menu`;
CREATE TABLE `ea_system_menu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '父id',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '名称',
  `icon` varchar(100) NOT NULL DEFAULT '' COMMENT '菜单图标',
  `href` varchar(100) DEFAULT '' COMMENT '链接',
  `params` varchar(500) DEFAULT '' COMMENT '链接参数',
  `target` varchar(20) NOT NULL DEFAULT '_self' COMMENT '链接打开方式',
  `sort` int(11) DEFAULT '0' COMMENT '菜单排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态(0:禁用,1:启用)',
  `remark` varchar(255) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  KEY `href` (`href`)
) ENGINE=InnoDB AUTO_INCREMENT=253 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统菜单表';

-- ----------------------------
-- Records of ea_system_menu
-- ----------------------------
INSERT INTO `ea_system_menu` VALUES ('227', '99999999', '后台首页', 'fa fa-home', 'index/welcome', NULL, '_self', '0', '1', NULL, NULL, '1573120497', NULL);
INSERT INTO `ea_system_menu` VALUES ('228', '0', '系统管理', 'fa fa-cog', NULL, NULL, '_self', '1', '1', NULL, NULL, '1713020061', NULL);
INSERT INTO `ea_system_menu` VALUES ('234', '228', '菜单管理', 'fa fa-tree', 'system.menu/index', NULL, '_self', '10', '1', NULL, NULL, '1588228555', NULL);
INSERT INTO `ea_system_menu` VALUES ('244', '228', '管理员管理', 'fa fa-user', 'system.admin/index', NULL, '_self', '12', '1', NULL, '1573185011', '1713106607', NULL);
INSERT INTO `ea_system_menu` VALUES ('245', '228', '角色管理', 'fa fa-bitbucket-square', 'system.auth/index', NULL, '_self', '11', '1', NULL, '1573435877', '1588228634', NULL);
INSERT INTO `ea_system_menu` VALUES ('246', '228', '节点管理', 'fa fa-list', 'system.node/index', NULL, '_self', '9', '1', NULL, '1573435919', '1588228648', NULL);
INSERT INTO `ea_system_menu` VALUES ('247', '228', '配置管理', 'fa fa-asterisk', 'system.config/index', NULL, '_self', '8', '1', NULL, '1573457448', '1588228566', NULL);
INSERT INTO `ea_system_menu` VALUES ('248', '228', '上传管理', 'fa fa-arrow-up', 'system.uploadfile/index', NULL, '_self', '0', '1', NULL, '1573542953', '1588228043', NULL);
INSERT INTO `ea_system_menu` VALUES ('249', '0', '商城管理', 'fa fa-list', NULL, NULL, '_self', '0', '0', NULL, '1589439884', '1711888690', '1711888690');
INSERT INTO `ea_system_menu` VALUES ('250', '249', '商品分类', 'fa fa-calendar-check-o', 'mall.cate/index', NULL, '_self', '0', '0', NULL, '1589439910', '1710256863', NULL);
INSERT INTO `ea_system_menu` VALUES ('251', '249', '商品管理', 'fa fa-list', 'mall.goods/index', NULL, '_self', '0', '0', NULL, '1589439931', '1710256862', NULL);
INSERT INTO `ea_system_menu` VALUES ('252', '228', '快捷入口', 'fa fa-list', 'system.quick/index', NULL, '_self', '0', '1', NULL, '1589623683', '1589623683', NULL);
INSERT INTO `ea_system_menu` VALUES ('253', '228', '日志管理', 'fa fa-connectdevelop', 'system.log/index', NULL, '_self', '0', '1', NULL, '1589623684', '1589623684', NULL);
INSERT INTO `ea_system_menu` VALUES ('257', '0', '导航管理', 'fa fa-list', NULL, NULL, '_self', '0', '1', NULL, '1709397627', '1710256861', NULL);
INSERT INTO `ea_system_menu` VALUES ('258', '257', '链接管理', 'fa fa-list', 'nav.link/index', NULL, '_self', '0', '1', NULL, '1709397645', '1713442200', NULL);
INSERT INTO `ea_system_menu` VALUES ('262', '257', '分类管理', 'fa fa-list', 'nav.node/index', NULL, '_self', '0', '1', NULL, '1709399375', '1713441847', NULL);
INSERT INTO `ea_system_menu` VALUES ('263', '257', '评论管理', 'fa fa-list', 'nav.comment/index', NULL, '_self', '0', '1', NULL, '1711193592', '1711193592', NULL);
INSERT INTO `ea_system_menu` VALUES ('264', '263', '通知管理', 'fa fa-list', 'nav.comment/index', NULL, '_self', '0', '0', NULL, '1711552468', '1711552505', '1711552505');
INSERT INTO `ea_system_menu` VALUES ('265', '257', '通知管理', 'fa fa-list', 'nav.bulletin/index', NULL, '_self', '0', '1', NULL, '1711552528', '1711552574', NULL);
INSERT INTO `ea_system_menu` VALUES ('266', '228', '用户信息', 'fa fa-address-book', 'system.user_info/index', NULL, '_self', '11', '1', NULL, '1711636472', '1711636545', NULL);
INSERT INTO `ea_system_menu` VALUES ('267', '267', '还原', 'fa fa-list', 'https://www.google.com.hk/', NULL, '_self', '0', '1', NULL, '1712935134', '1712935403', NULL);
INSERT INTO `ea_system_menu` VALUES ('268', '267', '备份', 'fa fa-list', '/WebsiteControl.Backup/index', NULL, '_self', '0', '1', NULL, '1712935295', '1712935382', NULL);
INSERT INTO `ea_system_menu` VALUES ('270', '0', '网站控制', 'fa fa-list', NULL, NULL, '_self', '1', '1', NULL, '1713019961', '1713020034', NULL);
INSERT INTO `ea_system_menu` VALUES ('271', '270', '还原', 'fa fa-list', 'WebsiteControl.reduction/index', NULL, '_self', '0', '1', NULL, '1713019979', '1713019979', NULL);
INSERT INTO `ea_system_menu` VALUES ('272', '270', '备份', 'fa fa-list', 'WebsiteControl.backup/index', NULL, '_self', '1', '1', NULL, '1713020006', '1713104591', NULL);

-- ----------------------------
-- Table structure for ea_system_node
-- ----------------------------
DROP TABLE IF EXISTS `ea_system_node`;
CREATE TABLE `ea_system_node` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `node` varchar(100) DEFAULT NULL COMMENT '节点代码',
  `title` varchar(500) DEFAULT NULL COMMENT '节点标题',
  `type` tinyint(1) DEFAULT '3' COMMENT '节点类型（1：控制器，2：节点）',
  `is_auth` tinyint(1) unsigned DEFAULT '1' COMMENT '是否启动RBAC权限控制',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `node` (`node`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统节点表';

-- ----------------------------
-- Records of ea_system_node
-- ----------------------------
INSERT INTO `ea_system_node` VALUES ('1', 'system.admin', '管理员管理', '1', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('2', 'system.admin/index', '列表', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('3', 'system.admin/add', '添加', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('4', 'system.admin/edit', '编辑', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('5', 'system.admin/password', '编辑', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('6', 'system.admin/delete', '删除', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('7', 'system.admin/modify', '属性修改', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('8', 'system.admin/export', '导出', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('9', 'system.auth', '角色权限管理', '1', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('10', 'system.auth/authorize', '授权', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('11', 'system.auth/saveAuthorize', '授权保存', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('12', 'system.auth/index', '列表', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('13', 'system.auth/add', '添加', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('14', 'system.auth/edit', '编辑', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('15', 'system.auth/delete', '删除', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('16', 'system.auth/export', '导出', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('17', 'system.auth/modify', '属性修改', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('18', 'system.config', '系统配置管理', '1', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('19', 'system.config/index', '列表', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('20', 'system.config/save', '保存', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('21', 'system.menu', '菜单管理', '1', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('22', 'system.menu/index', '列表', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('23', 'system.menu/add', '添加', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('24', 'system.menu/edit', '编辑', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('25', 'system.menu/delete', '删除', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('26', 'system.menu/modify', '属性修改', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('27', 'system.menu/getMenuTips', '添加菜单提示', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('28', 'system.menu/export', '导出', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('29', 'system.node', '系统节点管理', '1', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('30', 'system.node/index', '列表', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('31', 'system.node/refreshNode', '系统节点更新', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('32', 'system.node/clearNode', '清除失效节点', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('33', 'system.node/add', '添加', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('34', 'system.node/edit', '编辑', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('35', 'system.node/delete', '删除', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('36', 'system.node/export', '导出', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('37', 'system.node/modify', '属性修改', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('38', 'system.uploadfile', '上传文件管理', '1', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('39', 'system.uploadfile/index', '列表', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('40', 'system.uploadfile/add', '添加', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('41', 'system.uploadfile/edit', '编辑', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('42', 'system.uploadfile/delete', '删除', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('43', 'system.uploadfile/export', '导出', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('44', 'system.uploadfile/modify', '属性修改', '2', '1', '1589580432', '1589580432');
INSERT INTO `ea_system_node` VALUES ('60', 'system.quick', '快捷入口管理', '1', '1', '1589623188', '1589623188');
INSERT INTO `ea_system_node` VALUES ('61', 'system.quick/index', '列表', '2', '1', '1589623188', '1589623188');
INSERT INTO `ea_system_node` VALUES ('62', 'system.quick/add', '添加', '2', '1', '1589623188', '1589623188');
INSERT INTO `ea_system_node` VALUES ('63', 'system.quick/edit', '编辑', '2', '1', '1589623188', '1589623188');
INSERT INTO `ea_system_node` VALUES ('64', 'system.quick/delete', '删除', '2', '1', '1589623188', '1589623188');
INSERT INTO `ea_system_node` VALUES ('65', 'system.quick/export', '导出', '2', '1', '1589623188', '1589623188');
INSERT INTO `ea_system_node` VALUES ('66', 'system.quick/modify', '属性修改', '2', '1', '1589623188', '1589623188');
INSERT INTO `ea_system_node` VALUES ('67', 'system.log', '操作日志管理', '1', '1', '1589623188', '1589623188');
INSERT INTO `ea_system_node` VALUES ('68', 'system.log/index', '列表', '2', '1', '1589623188', '1589623188');
INSERT INTO `ea_system_node` VALUES ('118', 'system.user_info', 'system_user_info', '1', '1', '1711636412', '1711636412');
INSERT INTO `ea_system_node` VALUES ('119', 'system.user_info/index', '列表', '2', '1', '1711636412', '1711636412');
INSERT INTO `ea_system_node` VALUES ('120', 'system.user_info/add', '添加', '2', '1', '1711636412', '1711636412');
INSERT INTO `ea_system_node` VALUES ('121', 'system.user_info/edit', '编辑', '2', '1', '1711636412', '1711636412');
INSERT INTO `ea_system_node` VALUES ('122', 'system.user_info/delete', '删除', '2', '1', '1711636412', '1711636412');
INSERT INTO `ea_system_node` VALUES ('123', 'system.user_info/export', '导出', '2', '1', '1711636412', '1711636412');
INSERT INTO `ea_system_node` VALUES ('124', 'system.user_info/modify', '属性修改', '2', '1', '1711636412', '1711636412');
INSERT INTO `ea_system_node` VALUES ('138', 'nav.bulletin', '通告表', '1', '1', '1713871163', '1713871163');
INSERT INTO `ea_system_node` VALUES ('139', 'nav.bulletin/index', '列表', '2', '1', '1713871163', '1713871163');
INSERT INTO `ea_system_node` VALUES ('140', 'nav.bulletin/add', '添加', '2', '1', '1713871163', '1713871163');
INSERT INTO `ea_system_node` VALUES ('141', 'nav.bulletin/edit', '编辑', '2', '1', '1713871163', '1713871163');
INSERT INTO `ea_system_node` VALUES ('142', 'nav.bulletin/delete', '删除', '2', '1', '1713871163', '1713871163');
INSERT INTO `ea_system_node` VALUES ('143', 'nav.bulletin/export', '导出', '2', '1', '1713871163', '1713871163');
INSERT INTO `ea_system_node` VALUES ('144', 'nav.bulletin/modify', '属性修改', '2', '1', '1713871163', '1713871163');
INSERT INTO `ea_system_node` VALUES ('145', 'nav.comment', '评论表', '1', '1', '1713871163', '1713871163');
INSERT INTO `ea_system_node` VALUES ('146', 'nav.comment/modify', '属性修改', '2', '1', '1713871163', '1713871163');
INSERT INTO `ea_system_node` VALUES ('147', 'nav.comment/delete', '删除', '2', '1', '1713871163', '1713871163');
INSERT INTO `ea_system_node` VALUES ('148', 'nav.comment/add', '添加', '2', '1', '1713871163', '1713871163');
INSERT INTO `ea_system_node` VALUES ('149', 'nav.comment/edit', '编辑', '2', '1', '1713871163', '1713871163');
INSERT INTO `ea_system_node` VALUES ('150', 'nav.comment/export', '导出', '2', '1', '1713871163', '1713871163');
INSERT INTO `ea_system_node` VALUES ('151', 'nav.link', '链接表', '1', '1', '1713871163', '1713871229');
INSERT INTO `ea_system_node` VALUES ('152', 'nav.link/export', '导出', '2', '1', '1713871163', '1713871163');
INSERT INTO `ea_system_node` VALUES ('153', 'nav.link/modify', '属性修改', '2', '1', '1713871163', '1713871163');
INSERT INTO `ea_system_node` VALUES ('154', 'nav.node', '分类表', '1', '1', '1713871163', '1713871234');
INSERT INTO `ea_system_node` VALUES ('155', 'nav.node/export', '导出', '2', '1', '1713871163', '1713871163');
INSERT INTO `ea_system_node` VALUES ('156', 'WebsiteControl.backup', '备份控制', '1', '1', '1713871163', '1713871163');
INSERT INTO `ea_system_node` VALUES ('157', 'WebsiteControl.backup/index', '列表', '2', '1', '1713871163', '1713871163');
INSERT INTO `ea_system_node` VALUES ('158', 'WebsiteControl.reduction', '还原控制', '1', '1', '1713871163', '1713871163');
INSERT INTO `ea_system_node` VALUES ('159', 'WebsiteControl.reduction/index', '列表', '2', '1', '1713871163', '1713871163');
INSERT INTO `ea_system_node` VALUES ('160', 'WebsiteControl.reduction/upload', '上传', '2', '1', '1713871163', '1713871163');
INSERT INTO `ea_system_node` VALUES ('161', 'WebsiteControl.reduction/download', '下载', '2', '1', '1713871163', '1713871163');
INSERT INTO `ea_system_node` VALUES ('162', 'WebsiteControl.reduction/reduction', '还原', '2', '1', '1713871163', '1713871163');
INSERT INTO `ea_system_node` VALUES ('163', 'WebsiteControl.reduction/delete', '删除', '2', '1', '1713871163', '1713871163');
INSERT INTO `ea_system_node` VALUES ('164', 'WebsiteControl.upgrade', '升级控制', '1', '1', '1713871163', '1713871163');
INSERT INTO `ea_system_node` VALUES ('165', 'WebsiteControl.upgrade/index', '列表', '2', '1', '1713871163', '1713871163');
-- ----------------------------
-- Table structure for ea_system_quick
-- ----------------------------
DROP TABLE IF EXISTS `ea_system_quick`;
CREATE TABLE `ea_system_quick` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL COMMENT '快捷入口名称',
  `icon` varchar(100) DEFAULT NULL COMMENT '图标',
  `href` varchar(255) DEFAULT NULL COMMENT '快捷链接',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态(1:禁用,2:启用)',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注说明',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统快捷入口表';

-- ----------------------------
-- Records of ea_system_quick
-- ----------------------------
INSERT INTO `ea_system_quick` VALUES ('1', '管理员管理', 'fa fa-user', 'system.admin/index', '0', '1', '', '1589624097', '1589624792', null);
INSERT INTO `ea_system_quick` VALUES ('2', '角色管理', 'fa fa-bitbucket-square', 'system.auth/index', '0', '1', '', '1589624772', '1589624781', null);
INSERT INTO `ea_system_quick` VALUES ('3', '菜单管理', 'fa fa-tree', 'system.menu/index', '0', '1', null, '1589624097', '1589624792', null);
INSERT INTO `ea_system_quick` VALUES ('6', '节点管理', 'fa fa-list', 'system.node/index', '0', '1', null, '1589624772', '1589624781', null);
INSERT INTO `ea_system_quick` VALUES ('7', '配置管理', 'fa fa-asterisk', 'system.config/index', '0', '1', null, '1589624097', '1589624792', null);
INSERT INTO `ea_system_quick` VALUES ('8', '上传管理', 'fa fa-arrow-up', 'system.uploadfile/index', '0', '1', null, '1589624772', '1589624781', null);
INSERT INTO `ea_system_quick` VALUES ('10', '商品分类', 'fa fa-calendar-check-o', 'mall.cate/index', '0', '1', null, '1589624097', '1589624792', null);
INSERT INTO `ea_system_quick` VALUES ('11', '商品管理', 'fa fa-list', 'mall.goods/index', '0', '1', null, '1589624772', '1589624781', null);

-- ----------------------------
-- Table structure for ea_system_uploadfile
-- ----------------------------
DROP TABLE IF EXISTS `ea_system_uploadfile`;
CREATE TABLE `ea_system_uploadfile` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `upload_type` varchar(20) NOT NULL DEFAULT 'local' COMMENT '存储位置',
  `original_name` varchar(255) DEFAULT NULL COMMENT '文件原名',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '物理路径',
  `image_width` varchar(30) NOT NULL DEFAULT '' COMMENT '宽度',
  `image_height` varchar(30) NOT NULL DEFAULT '' COMMENT '高度',
  `image_type` varchar(30) NOT NULL DEFAULT '' COMMENT '图片类型',
  `image_frames` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '图片帧数',
  `mime_type` varchar(100) NOT NULL DEFAULT '' COMMENT 'mime类型',
  `file_size` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `file_ext` varchar(100) DEFAULT NULL,
  `sha1` varchar(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `create_time` int(10) DEFAULT NULL COMMENT '创建日期',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间',
  `upload_time` int(10) DEFAULT NULL COMMENT '上传时间',
  PRIMARY KEY (`id`),
  KEY `upload_type` (`upload_type`),
  KEY `original_name` (`original_name`)
) ENGINE=InnoDB AUTO_INCREMENT=316 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='上传文件表';

-- ----------------------------
-- Records of ea_system_uploadfile
-- ----------------------------
INSERT INTO `ea_system_uploadfile` VALUES ('286', 'alioss', 'image/jpeg', 'https://lxn-99php.oss-cn-shenzhen.aliyuncs.com/upload/20191111/0a6de1ac058ee134301501899b84ecb1.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', null, null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('287', 'alioss', 'image/jpeg', 'https://lxn-99php.oss-cn-shenzhen.aliyuncs.com/upload/20191111/46d7384f04a3bed331715e86a4095d15.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', null, null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('288', 'alioss', 'image/x-icon', 'https://lxn-99php.oss-cn-shenzhen.aliyuncs.com/upload/20191111/7d32671f4c1d1b01b0b28f45205763f9.ico', '', '', '', '0', 'image/x-icon', '0', 'ico', '', null, null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('289', 'alioss', 'image/jpeg', 'https://lxn-99php.oss-cn-shenzhen.aliyuncs.com/upload/20191111/28cefa547f573a951bcdbbeb1396b06f.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', null, null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('290', 'alioss', 'image/jpeg', 'https://lxn-99php.oss-cn-shenzhen.aliyuncs.com/upload/20191111/2c412adf1b30c8be3a913e603c7b6e4a.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', null, null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('291', 'alioss', 'timg (1).jpg', 'http://easyadmin.oss-cn-shenzhen.aliyuncs.com/upload/20191113/ff793ced447febfa9ea2d86f9f88fa8e.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', '1573612437', null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('296', 'txcos', '22243.jpg', 'https://easyadmin-1251997243.cos.ap-guangzhou.myqcloud.com/upload/20191114/2381eaf81208ac188fa994b6f2579953.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', '1573712153', null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('297', 'local', 'timg.jpg', 'http://admin.host/upload/20200423/5055a273cf8e3f393d699d622b74f247.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', '1587614155', null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('298', 'local', 'timg.jpg', 'http://admin.host/upload/20200423/243f4e59f1b929951ef79c5f8be7468a.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', '1587614269', null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('299', 'local', 'head.jpg', 'http://admin.host/upload/20200512/a5ce9883379727324f5686ef61205ce2.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', '1589255649', null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('300', 'local', '896e5b87c9ca70e4.jpg', 'http://admin.host/upload/20200514/577c65f101639f53dbbc9e7aa346f81c.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', '1589427798', null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('301', 'local', '896e5b87c9ca70e4.jpg', 'http://admin.host/upload/20200514/98fc09b0c4ad4d793a6f04bef79a0edc.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', '1589427840', null, null);
INSERT INTO `ea_system_uploadfile` VALUES ('302', 'local', '18811e7611c8f292.jpg', 'http://admin.host/upload/20200514/e1c6c9ef6a4b98b8f7d95a1a0191a2df.jpg', '', '', '', '0', 'image/jpeg', '0', 'jpg', '', '1589438645', null, null);

-- ----------------------------
-- Table structure for ea_system_user_info
-- ----------------------------
DROP TABLE IF EXISTS `ea_system_user_info`;
CREATE TABLE `ea_system_user_info` (
                                       `id` int(11) NOT NULL AUTO_INCREMENT,
                                       `username` varchar(20) NOT NULL COMMENT '用户表用户名{text}\r\n',
                                       `nickname` varchar(20) NOT NULL COMMENT '昵称{text}',
                                       `sign` varchar(100) DEFAULT NULL COMMENT '签名{text}',
                                       `web` varchar(255) DEFAULT NULL COMMENT '个人网站{text}',
                                       `qq` varchar(20) DEFAULT NULL COMMENT 'QQ{text}',
                                       `wechat` varchar(255) DEFAULT NULL COMMENT '微信{text}',
                                       `email` varchar(255) DEFAULT NULL COMMENT '邮箱{text}',
                                       `delete_time` bigint(11) DEFAULT NULL,
                                       PRIMARY KEY (`id`),
                                       UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;


-- ----------------------------
-- Table structure for ea_nav_node
-- ----------------------------
DROP TABLE IF EXISTS `ea_nav_node`;
CREATE TABLE `ea_nav_node` (
                               `id` int(11) NOT NULL AUTO_INCREMENT,
                               `name` varchar(50) NOT NULL COMMENT '类名{text}',
                               `pid` int(2) DEFAULT '0' COMMENT '类的级别为0是1级有值是对应id{select}\r\n',
                               `icon` text COMMENT '图标标签{text}',
                               `display_type` int(2) NOT NULL DEFAULT '1' COMMENT '显示类型{select}(1:default,2:mini,3:book,4:app)',
                               `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态{radio}(0:不展示,1:展示)',
                               `create_time` bigint(11) NOT NULL COMMENT '创建时间{date}(datetime)',
                               `update_time` bigint(11) NOT NULL COMMENT '更新时间{date}(datetime)\r\n',
                               `delete_time` bigint(11) DEFAULT NULL COMMENT '软删除{date}(datetime)',
                               PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COMMENT='分类表';

-- ----------------------------
-- Table structure for ea_nav_links
-- ----------------------------
DROP TABLE IF EXISTS `ea_nav_links`;
CREATE TABLE `ea_nav_links` (
                                `id` int(11) NOT NULL AUTO_INCREMENT,
                                `node_id` int(4) NOT NULL COMMENT '分类表ID，为0表示友链\r\n{select}',
                                `name` varchar(255) NOT NULL COMMENT '接口名{text}',
                                `url` varchar(255) DEFAULT NULL COMMENT '接口对应URL{text}',
                                `description` varchar(255) NOT NULL COMMENT '接口描述{editor}',
                                `image_path` varchar(255) DEFAULT '6NCNGCcPkPeebXmr' COMMENT '图片路径{text}',
                                `status` int(3) NOT NULL DEFAULT '0' COMMENT '状态{select} (0:展示, 1:不展示,2:审核中,3:类-不展示,4:链接不可用)',
                                `create_time` bigint(11) NOT NULL COMMENT '录入时间{date}(datetime)\r\n',
                                `delete_time` bigint(11) DEFAULT NULL COMMENT '软删除{date}(datetime)',
                                PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COMMENT='链接信息表';

-- ----------------------------
-- Table structure for ea_nav_comment
-- ----------------------------
DROP TABLE IF EXISTS `ea_nav_comment`;
CREATE TABLE `ea_nav_comment` (
                                  `id` int(11) NOT NULL AUTO_INCREMENT,
                                  `author` varchar(20) NOT NULL COMMENT '昵称{text}',
                                  `url` varchar(50) DEFAULT NULL COMMENT 'url{text}',
                                  `email` varchar(50) DEFAULT NULL COMMENT '邮箱{text}',
                                  `content` text NOT NULL COMMENT '内容{textarea}',
                                  `reply_id` int(2) NOT NULL DEFAULT '1' COMMENT '表示回复的类型，\r\n0--1级评论\r\n>0--回复目标的id\r\n{text}',
                                  `place` varchar(15) NOT NULL DEFAULT '中国' COMMENT '评论地点{text}',
                                  `create_time` bigint(11) NOT NULL COMMENT '评论日期{datetime}',
                                  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态{switch}(0:不展示,1:展示)',
                                  `delete_time` bigint(11) DEFAULT NULL COMMENT '删除日期{datetime}',
                                  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COMMENT='评论表';


-- ----------------------------
-- Table structure for ea_nav_bulletin
-- ----------------------------
DROP TABLE IF EXISTS `ea_nav_bulletin`;
CREATE TABLE `ea_nav_bulletin` (
                                   `id` int(11) NOT NULL AUTO_INCREMENT,
                                   `admin_id` int(11) NOT NULL COMMENT '管理员id{select}',
                                   `title` varchar(15) NOT NULL COMMENT '标题{text}',
                                   `content` varchar(255) NOT NULL COMMENT '内容{text}',
                                   `top` int(2) NOT NULL DEFAULT '0' COMMENT '置顶{radio}(0:不置顶,1:置顶)',
                                   `status` int(2) NOT NULL DEFAULT '1' COMMENT '状态{radio}(0:展示,1:隐藏)',
                                   `create_time` int(11) DEFAULT NULL COMMENT '添加时间{date}(datetime)',
                                   `delete_time` int(11) DEFAULT NULL COMMENT '删除时间{date}(datetime)',
                                   PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COMMENT='通告表';
