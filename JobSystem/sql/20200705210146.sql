/*
MySQL Backup
Database: jobsystem
Backup Time: 2020-07-05 21:01:46
*/

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `jobsystem`.`enterprise`;
DROP TABLE IF EXISTS `jobsystem`.`job`;
DROP TABLE IF EXISTS `jobsystem`.`user`;
CREATE TABLE `enterprise` (
  `id` int NOT NULL COMMENT '企业的id',
  `Logo` varchar(255) DEFAULT NULL COMMENT '企业的logo',
  `Name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT '企业名称',
  `Domain` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT '领域',
  `Stage` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT '发展阶段',
  `Scale` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT '规模',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `detail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT '公司详情',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `job` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '岗位的id',
  `Name` varchar(100) DEFAULT NULL COMMENT '岗位名称',
  `Low_salary` int DEFAULT NULL COMMENT '最低薪酬',
  `High_salary` int DEFAULT NULL COMMENT '最高薪酬',
  `Address` varchar(100) DEFAULT NULL COMMENT '工作地点',
  `Experience` varchar(100) DEFAULT NULL COMMENT '经验要求',
  `Education` varchar(100) DEFAULT NULL COMMENT '学历要求',
  `Is_parttime` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT '是否是兼职 1-兼职 2-全职',
  `Create_time` datetime DEFAULT NULL COMMENT '发布时间',
  `enterprise` varchar(100) DEFAULT NULL COMMENT '发布的企业',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '用户的ID',
  `name` varchar(100) DEFAULT NULL COMMENT '用户的姓名',
  `Phone` varchar(11) DEFAULT NULL COMMENT '用户的手机',
  `Password` varchar(30) DEFAULT NULL COMMENT '密码',
  `Type` char(1) DEFAULT NULL COMMENT '用户类型 0-管理员 1-企业 2-求职者',
  `Gender` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT '性别 1-男 0-女',
  `Create_time` datetime DEFAULT NULL COMMENT '注册时间',
  `Enable` char(1) DEFAULT NULL COMMENT '账号是否可用 0-不可用 1-可用',
  `photo` varchar(200) DEFAULT NULL COMMENT '用户头像的地址',
  `txt` varchar(200) DEFAULT NULL COMMENT '用户自我简介的地址',
  `upload` varchar(200) DEFAULT NULL COMMENT '企业用户上传图片的地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
BEGIN;
LOCK TABLES `jobsystem`.`enterprise` WRITE;
DELETE FROM `jobsystem`.`enterprise`;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `jobsystem`.`job` WRITE;
DELETE FROM `jobsystem`.`job`;
UNLOCK TABLES;
COMMIT;
BEGIN;
LOCK TABLES `jobsystem`.`user` WRITE;
DELETE FROM `jobsystem`.`user`;
INSERT INTO `jobsystem`.`user` (`id`,`name`,`Phone`,`Password`,`Type`,`Gender`,`Create_time`,`Enable`,`photo`,`txt`,`upload`) VALUES (1, '管理员', '123456789', '123456789', '0', '1', '2020-07-31 18:44:52', '1', './uploads/1-啊这.png', './data/1.txt', NULL);
UNLOCK TABLES;
COMMIT;
