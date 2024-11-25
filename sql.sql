INSERT INTO gs_an_table(name,email,naiyou,indate)VALUES('山崎','test01@','ないよ！',sysdate());
INSERT INTO gs_an_table(name,email,naiyou,indate)VALUES('山田','test02@','ないよ！',sysdate());
INSERT INTO gs_an_table(name,email,naiyou,indate)VALUES('山口','test03@','ないよ！',sysdate());
INSERT INTO gs_an_table(name,email,naiyou,indate)VALUES('山本','test04@','ないよ！',sysdate());
INSERT INTO gs_an_table(name,email,naiyou,indate)VALUES('山門','test05@','ないよ！',sysdate());

SELECT * FROM gs_an_table;
SELECT name,id FROM gs_an_table;

SELECT * FROM gs_an_table WHERE id=2;
SELECT * FROM gs_an_table WHERE name LIKE '%崎%';

SELECT * FROM gs_an_table ORDER BY id DESC;
SELECT * FROM gs_an_table ORDER BY id DESC LIMT 3;

INSERT INTO gs_an_table(name,email,naiyou,indate)VALUES(:name,:email,:naiyou,sysdate());