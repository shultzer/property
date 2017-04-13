

-- SELECT

SELECT * FROM city LIMIT 5;

SELECT `Name`, `Population` FROM city WHERE id BETWEEN 4 and 10;

SELECT  * FROM city ORDER BY Name  LIMIT 100 OFFSET 1;

select * from ( select * from city order by id limit 20) tmp order by tmp.Name DESC

SELECT  * FROM city WHERE id = (select id from city where name='Moscow' limit 1);


SELECT  co.Name, ci.Name, ci.Population FROM city ci
INNER JOIN country co ON ci.CountryCode = co.Code;

SELECT  co.Name, ci.Name, ci.Population FROM city ci
CROSS JOIN country co;
-- UPDATE
UPDATE city
SET
  District=CONCAT(CountryCode, Name, '!!!'),
  Population=100;

-- INSERT
INSERT INTO city VALUES (null, 'TEST', 'AFG', 'TEST', 222222);
INSERT INTO city (CountryCode, Name) VALUES('AFG', 'MyNameIsBest');

INSERT INTO city VALUES (null, 'TEST', 'AFG', 'TEST1', 222222), (null, 'TEST2', 'AFG', 'TEST', 222222), (null, 'TEST3', 'AFG', 'TEST', 222222);
-- DELETE
DELETE FROM city WHERE ID >= 4084;