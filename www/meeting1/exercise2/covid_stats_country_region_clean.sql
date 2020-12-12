
## Bahamas, The -> Bahamas

-- BEGIN;
-- SAVEPOINT my_savepoint;

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Bahamas';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Bahamas, The';
UPDATE `covid_stats` SET `country_region`='Bahamas' WHERE `country_region`='Bahamas, The';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Bahamas, The';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Bahamas';

-- ROLLBACK to my_savepoint;
-- COMMIT;

## Diamond Princess, MS Zaandam and Others -> Cruise Ship

-- BEGIN;
-- SAVEPOINT my_savepoint;

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Cruise Ship';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Diamond Princess';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'MS Zaandam';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Others';

UPDATE `covid_stats` SET `country_region`='Cruise Ship' WHERE `country_region`='Diamond Princess';
UPDATE `covid_stats` SET `country_region`='Cruise Ship' WHERE `country_region`='MS Zaandam';
UPDATE `covid_stats` SET `country_region`='Cruise Ship' WHERE `country_region`='Others';

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Diamond Princess';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'MS Zaandam';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Others';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Cruise Ship';

-- ROLLBACK to my_savepoint;
-- COMMIT;

## French Guiana, Mayotte, Reunion -> France

-- BEGIN;
-- SAVEPOINT my_savepoint;

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'France';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'French Guiana';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Mayotte';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Reunion';

UPDATE `covid_stats` SET `country_region`='France' WHERE `country_region`='French Guiana';
UPDATE `covid_stats` SET `country_region`='France' WHERE `country_region`='Mayotte';
UPDATE `covid_stats` SET `country_region`='France' WHERE `country_region`='Reunion';

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'French Guiana';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'MS Zaandam';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Reunion';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'France';

-- ROLLBACK to my_savepoint;
-- COMMIT;

## Gambia, The -> Gambia

-- BEGIN;
-- SAVEPOINT my_savepoint;

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Gambia';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Gambia, The';

UPDATE `covid_stats` SET `country_region`='Gambia' WHERE `country_region`='Gambia, The';

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Gambia, The';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Gambia';

-- ROLLBACK to my_savepoint;
-- COMMIT;

## Vatican City -> Holy See

-- BEGIN;
-- SAVEPOINT my_savepoint;

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Holy See';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Vatican City';

UPDATE `covid_stats` SET `country_region`='Holy See' WHERE `country_region`='Vatican City';

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Vatican City';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Holy See';

-- ROLLBACK to my_savepoint;
-- COMMIT;

## Hong Kong SAR -> Hong Kong

-- BEGIN;
-- SAVEPOINT my_savepoint;

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Hong Kong';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Hong Kong SAR';

UPDATE `covid_stats` SET `country_region`='Hong Kong' WHERE `country_region`='Hong Kong SAR';

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Hong Kong SAR';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Hong Kong';

-- ROLLBACK to my_savepoint;
-- COMMIT;

## Iran (Islamic Republic of) -> Iran

-- BEGIN;
-- SAVEPOINT my_savepoint;

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Iran';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Iran (Islamic Republic of)';

UPDATE `covid_stats` SET `country_region`='Iran' WHERE `country_region`='Iran (Islamic Republic of)';

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Iran (Islamic Republic of)';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Iran';

-- ROLLBACK to my_savepoint;
-- COMMIT;

## Republic of Korea and South Korea -> Korea, South

-- BEGIN;
-- SAVEPOINT my_savepoint;

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Korea, South';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Republic of Korea';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'South Korea';

UPDATE `covid_stats` SET `country_region`='Korea, South' WHERE `country_region`='Republic of Korea';
UPDATE `covid_stats` SET `country_region`='Korea, South' WHERE `country_region`='South Korea';

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Republic of Korea';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'South Korea';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Korea, South';

-- ROLLBACK to my_savepoint;
-- COMMIT;

## Macao SAR -> Macau

-- BEGIN;
-- SAVEPOINT my_savepoint;

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Macau';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Macao SAR';

UPDATE `covid_stats` SET `country_region`='Macau' WHERE `country_region`='Macao SAR';

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Macao SAR';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Macau';

-- ROLLBACK to my_savepoint;
-- COMMIT;

## Mainland China -> China

-- BEGIN;
-- SAVEPOINT my_savepoint;

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'China';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Mainland China';

UPDATE `covid_stats` SET `country_region`='China' WHERE `country_region`='Mainland China';

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Mainland China';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'China';

-- ROLLBACK to my_savepoint;
-- COMMIT;

## occupied Palestinian territory and Palestine -> West Bank and Gaza

-- BEGIN;
-- SAVEPOINT my_savepoint;

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'West Bank and Gaza';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'occupied Palestinian territory';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Palestine';

UPDATE `covid_stats` SET `country_region`='West Bank and Gaza' WHERE `country_region`='occupied Palestinian territory';
UPDATE `covid_stats` SET `country_region`='West Bank and Gaza' WHERE `country_region`='Palestine';

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'occupied Palestinian territory';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Palestine';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'West Bank and Gaza';

-- ROLLBACK to my_savepoint;
-- COMMIT;

## Republic of Moldova -> Moldova

-- BEGIN;
-- SAVEPOINT my_savepoint;

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Moldova';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Republic of Moldova';

UPDATE `covid_stats` SET `country_region`='Moldova' WHERE `country_region`='Republic of Moldova';

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Republic of Moldova';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Moldova';

-- ROLLBACK to my_savepoint;
-- COMMIT;

## Republic of the Congo -> Congo (Brazzaville)

-- BEGIN;
-- SAVEPOINT my_savepoint;

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Congo (Brazzaville)';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Republic of the Congo';

UPDATE `covid_stats` SET `country_region`='Congo (Brazzaville)' WHERE `country_region`='Republic of the Congo';

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Republic of the Congo';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Congo (Brazzaville)';

-- ROLLBACK to my_savepoint;
-- COMMIT;

## Russian Federation -> Russia

-- BEGIN;
-- SAVEPOINT my_savepoint;

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Russia';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Russian Federation';

UPDATE `covid_stats` SET `country_region`='Russia' WHERE `country_region`='Russian Federation';

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Russian Federation';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Russia';

-- ROLLBACK to my_savepoint;
-- COMMIT;

## Taipei and environs and Taiwan -> Taiwan*

-- BEGIN;
-- SAVEPOINT my_savepoint;

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Taiwan*';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Taipei and environs';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Taiwan';

UPDATE `covid_stats` SET `country_region`='Taiwan*' WHERE `country_region`='Taipei and environs';
UPDATE `covid_stats` SET `country_region`='Taiwan*' WHERE `country_region`='Taiwan';

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Taipei and environs';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Taiwan';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Taiwan*';

-- ROLLBACK to my_savepoint;
-- COMMIT;

## UK -> United Kingdom

-- BEGIN;
-- SAVEPOINT my_savepoint;

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'United Kingdom';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'UK';

UPDATE `covid_stats` SET `country_region`='United Kingdom' WHERE `country_region`='UK';

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'UK';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'United Kingdom';

-- ROLLBACK to my_savepoint;
-- COMMIT;

## Viet Nam -> Vietnam

-- BEGIN;
-- SAVEPOINT my_savepoint;

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Vietnam';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Viet Nam';

UPDATE `covid_stats` SET `country_region`='Vietnam' WHERE `country_region`='Viet Nam';

SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Viet Nam';
SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'Vietnam';

-- ROLLBACK to my_savepoint;
-- COMMIT;

## US -> United States

-- BEGIN;
-- SAVEPOINT my_savepoint;

-- SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'US';
-- SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'United States';

-- UPDATE `covid_stats` SET `country_region`='United States' WHERE `country_region`='US';

-- SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'United States';
-- SELECT COUNT(*) FROM `covid_stats` WHERE `country_region` LIKE 'US';

-- ROLLBACK to my_savepoint;
-- COMMIT;