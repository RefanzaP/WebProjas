/*
 Navicat Premium Data Transfer

 Source Server         : Mysql
 Source Server Type    : MySQL
 Source Server Version : 100113
 Source Host           : localhost:3306
 Source Schema         : scum

 Target Server Type    : MySQL
 Target Server Version : 100113
 File Encoding         : 65001

 Date: 12/11/2018 20:01:07
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for data_pengeluaran
-- ----------------------------
DROP TABLE IF EXISTS `data_pengeluaran`;
CREATE TABLE `data_pengeluaran`  (
  `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_servisan` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nota` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `jumlah` int(11) NULL DEFAULT NULL,
  `create_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NULL DEFAULT 0,
  PRIMARY KEY (`id_pengeluaran`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of data_pengeluaran
-- ----------------------------
INSERT INTO `data_pengeluaran` VALUES (1, '1', '1', '1537360143_Ganti_Hardisk__19-09-2018.jpg', 'Ganti Hardisk ', 550000, '2018-09-19 19:29:04', 0);

-- ----------------------------
-- Table structure for data_servis
-- ----------------------------
DROP TABLE IF EXISTS `data_servis`;
CREATE TABLE `data_servis`  (
  `id_data_servis` int(11) NOT NULL AUTO_INCREMENT,
  `id_servisan` int(11) NOT NULL,
  `id_teknisi` int(11) NOT NULL,
  `id_servis` int(11) NOT NULL,
  `biaya` double NOT NULL,
  `create_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_data_servis`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of data_servis
-- ----------------------------
INSERT INTO `data_servis` VALUES (1, 1, 1, 1, 35000, '2018-09-19 19:26:52');

-- ----------------------------
-- Table structure for personal_data
-- ----------------------------
DROP TABLE IF EXISTS `personal_data`;
CREATE TABLE `personal_data`  (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jk` tinyint(4) NOT NULL,
  `no_telp` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `foto` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gaji` double NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of personal_data
-- ----------------------------
INSERT INTO `personal_data` VALUES (1, 'Moch Annafia O', 'Malang Kota', 1, '089878676576', 'Moch_Annafia_O_08-01-2018_1515350042.jpg', 73000);
INSERT INTO `personal_data` VALUES (4, 'Siti Zulaihah', 'Malang', 2, '0', '', 0);

-- ----------------------------
-- Table structure for servis
-- ----------------------------
DROP TABLE IF EXISTS `servis`;
CREATE TABLE `servis`  (
  `id_servis` int(11) NOT NULL AUTO_INCREMENT,
  `nama_servis` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `biaya` double NOT NULL,
  PRIMARY KEY (`id_servis`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of servis
-- ----------------------------
INSERT INTO `servis` VALUES (1, 'Install Ulang Windows', 35000);
INSERT INTO `servis` VALUES (2, 'Ganti Keyboard', 50000);
INSERT INTO `servis` VALUES (3, 'Bersihkan Virus', 35000);
INSERT INTO `servis` VALUES (4, 'Bersihkan Laptop dan Ganti Thermal Paste', 35000);

-- ----------------------------
-- Table structure for servisan
-- ----------------------------
DROP TABLE IF EXISTS `servisan`;
CREATE TABLE `servisan`  (
  `id_servisan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_cust` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `no_telp` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_masuk` datetime(0) NOT NULL,
  `tgl_kembali` datetime(0) NOT NULL,
  `jns_barang` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kelengkapan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `penerima` int(11) NOT NULL,
  `teknisi` int(11) NOT NULL,
  `keluhan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` tinyint(11) NOT NULL,
  `status_kembali` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_servisan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of servisan
-- ----------------------------
INSERT INTO `servisan` VALUES (1, 'xii rpl', '08928192891', '2018-09-19 19:23:33', '2018-09-19 19:29:35', 'Laptop', 'unit,charger,tas', 1, 1, 'windows masih error', 1, 1);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `repassword` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 4,
  `auth` tinyint(4) NOT NULL DEFAULT 1,
  `create_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime(0) NOT NULL,
  `last_logout` datetime(0) NOT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'bonekberdasi@gmail.com', '5a0c2b33ef02b6ff02eff528efef7b16', 'september09', 1, 1, '2018-01-09 03:01:47', '2018-11-12 19:02:16', '2018-09-05 14:07:41');
INSERT INTO `user` VALUES (4, 'sitizulaihah0602@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '1', 3, 1, '2018-01-14 11:17:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

SET FOREIGN_KEY_CHECKS = 1;
