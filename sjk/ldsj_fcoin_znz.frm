TYPE=VIEW
query=select `b`.`id` AS `betId`,`b`.`type` AS `type`,`b`.`playedId` AS `playedId`,`b`.`qz_uid` AS `qz_uid`,`b`.`qz_username` AS `qz_username`,`b`.`actionNo` AS `actionNo`,`b`.`qz_time` AS `qz_Time`,`l`.`info` AS `info`,`l`.`liqType` AS `liqType`,`l`.`fcoin` AS `fcoin` from `ssc2014`.`ldsj_coin_log` `l` join `ssc2014`.`ldsj_bets` `b` where ((`b`.`id` = `l`.`extfield0`) and (`b`.`isDelete` = 0) and (`b`.`lotteryNo` = \'\') and (`l`.`liqType` = 100))
md5=17f5967e4f3887ecfc69878b8783a910
updatable=1
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2014-11-27 08:14:50
create-version=1
source=select b.id betId, b.type, b.playedId, b.qz_uid, b.qz_username, b.actionNo, b.qz_Time, l.info, l.liqType, l.fcoin from ldsj_coin_log l, ldsj_bets b where b.id=l.extfield0 and b.isDelete=0 and b.lotteryNo=\'\' and l.liqType=100
client_cs_name=utf8
connection_cl_name=utf8_general_ci
view_body_utf8=select `b`.`id` AS `betId`,`b`.`type` AS `type`,`b`.`playedId` AS `playedId`,`b`.`qz_uid` AS `qz_uid`,`b`.`qz_username` AS `qz_username`,`b`.`actionNo` AS `actionNo`,`b`.`qz_time` AS `qz_Time`,`l`.`info` AS `info`,`l`.`liqType` AS `liqType`,`l`.`fcoin` AS `fcoin` from `ssc2014`.`ldsj_coin_log` `l` join `ssc2014`.`ldsj_bets` `b` where ((`b`.`id` = `l`.`extfield0`) and (`b`.`isDelete` = 0) and (`b`.`lotteryNo` = \'\') and (`l`.`liqType` = 100))
