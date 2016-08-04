select * from Sections order by id desc
select * from Units order by id desc
select * from Descriptions order by id desc
select * from Exercises order by id desc
select * from Questions order by id desc
select * from textBoxes order by id desc
select * from Answers order by id desc


insert into Descriptions values (null, '', 58)

insert into Exercises values 
(null, 3, '', 57, null, null) -- id, number, desc, unitId, const

insert into Questions values (null,
"The fine weather helped (make) #tbx1# it a very enjoyable holiday."
, 201) -- id, content, exerciseId
select LAST_INSERT_ID();

insert into textBoxes values
(null, 1239) -- id, questionID

insert into Answers values
(null,  1406, "make") -- id, textBoxId, content
,(null, 1406, "          ")

