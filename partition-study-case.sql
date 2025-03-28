# drop database laravel;
# create database laravel;

select count(*) from animes;

select count(*) from animes
where aired_year in (2021, 2022, 2023);

select aired_year, count(*) as occurrence
from animes
group by aired_year
order by occurrence desc;

ALTER TABLE animes
DROP PRIMARY KEY,
ADD PRIMARY KEY (id, aired_year);

ALTER TABLE animes
    PARTITION BY RANGE (aired_year) (
    PARTITION p2020 VALUES LESS THAN (2020),
    PARTITION p2021 VALUES LESS THAN MAXVALUE
    );

alter table animes
    add index idx_aired_year (aired_year);
