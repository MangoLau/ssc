TYPE=VIEW
query=select `b`.`id` AS `betId`,`b`.`type` AS `type`,`b`.`playedId` AS `playedId`,`b`.`uid` AS `uid`,`b`.`username` AS `username`,`b`.`actionNo` AS `actionNo`,`b`.`actionTime` AS `actionTime`,`l`.`info` AS `info`,`l`.`liqType` AS `liqType`,`l`.`fcoin` AS `fcoin` from `ssc2014`.`ldsj_coin_log` `l` join `ssc2014`.`ldsj_bets` `b` where ((`b`.`id` = `l`.`extfield0`) and (`b`.`isDelete` = 0) and (`b`.`lotteryNo` = \'\') and (`l`.`liqType` between 101 and 102))
md5=bae48cfa5b7f5bb300cf8e4c9bfdb00f
updatable=1
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2014-11-14 16:47:52
create-version=1
source=select b.id betId, b.type, b.playedId, b.uid, b.username, b.actionNo, b.actionTime, l.info, l.liqType, l.fcoin from ldsj_coin_log l, ldsj_bets b where b.id=l.extfield0 and b.isDelete=0 and b.lotteryNo=\'\' and l.liqType between 101 and 102
client_cs_name=utf8
connection_cl_name=utf8_general_ci
view_body_utf8=select `b`.`id` AS `betId`,`b`.`type` AS `type`,`b`.`playedId` AS `playedId`,`b`.`uid` AS `uid`,`b`.`username` AS `username`,`b`.`actionNo` AS `actionNo`,`b`.`actionTime` AS `actionTime`,`l`.`info` AS `info`,`l`.`liqType` AS `liqType`,`l`.`fcoin` AS `fcoin` from `ssc2014`.`ldsj_coin_log` `l` join `ssc2014`.`ldsj_bets` `b` where ((`b`.`id` = `l`.`extfield0`) and (`b`.`isDelete` = 0) and (`b`.`lotteryNo` = \'\') and (`l`.`liqType` between 101 and 102))
