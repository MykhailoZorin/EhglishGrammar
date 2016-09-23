select * from Sections order by id desc
select * from Units order by id desc
select * from Descriptions order by id desc
select * from Exercises order by id desc
select * from Questions order by id desc
select * from textBoxes order by id desc
select * from Answers order by id desc

select * FROM Questions where content like "%sentance%"

insert into Descriptions values (null, '', 58)

insert into Descriptions values (null, '', 66)

insert into Exercises values 
(null, 4, '', 66, null, null) -- id, number, desc, unitId, const

insert into Questions values (null,
"Helen wouldn't dream (buy) #tbx1# me lunch."
, 239) -- id, content, exerciseId
select LAST_INSERT_ID();

insert into textBoxes values
(null, 1441) -- id, questionID

insert into Answers values
(null,  1617, "of buying") -- id, textBoxId, content
,(null, 1617, "           ")

