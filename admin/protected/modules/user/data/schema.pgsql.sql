BEGIN TRANSACTION;
CREATE TABLE tbl_migration (
	"version" varchar(255) NOT NULL PRIMARY KEY,
	"apply_time" integer
);
INSERT INTO "tbl_migration" VALUES('m000000_000000_base',1348651030);
INSERT INTO "tbl_migration" VALUES('m110805_153437_installYiiUser',1348651049);
INSERT INTO "tbl_migration" VALUES('m110810_162301_userTimestampFix',1348651049);
CREATE TABLE tbl_profiles (
	"user_id" serial PRIMARY KEY NOT NULL,
	"first_name" varchar(255),
	"last_name" varchar(255)
);
INSERT INTO "tbl_profiles" VALUES(1,'Administrator','Admin');
CREATE TABLE tbl_profiles_fields (
	"id" serial PRIMARY KEY NOT NULL,
	"varname" varchar(50) NOT NULL,
	"title" varchar(255) NOT NULL,
	"field_type" varchar(50) NOT NULL,
	"field_size" int NOT NULL,
	"field_size_min" int NOT NULL,
	"required" int NOT NULL,
	"match" varchar(255) NOT NULL,
	"range" varchar(255) NOT NULL,
	"error_message" varchar(255) NOT NULL,
	"other_validator" text NOT NULL,
	"default" varchar(255) NOT NULL,
	"widget" varchar(255) NOT NULL,
	"widgetparams" text NOT NULL,
	"position" int NOT NULL,
	"visible" int NOT NULL
);
INSERT INTO "tbl_profiles_fields" VALUES(1,'first_name','First Name','VARCHAR',255,3,2,'','','Incorrect First Name (length between 3 and 50 characters).','','','','',1,3);
INSERT INTO "tbl_profiles_fields" VALUES(2,'last_name','Last Name','VARCHAR',255,3,2,'','','Incorrect Last Name (length between 3 and 50 characters).','','','','',2,3);
CREATE TABLE tbl_users (
	"id" serial PRIMARY KEY NOT NULL,
	"username" varchar(20) NOT NULL,
	"password" varchar(128) NOT NULL,
	"email" varchar(128) NOT NULL,
	"activkey" varchar(128) NOT NULL,
	"superuser" int NOT NULL,
	"status" int NOT NULL,
	"create_at" TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	"lastvisit_at" TIMESTAMP
);
INSERT INTO "tbl_users" VALUES(1,'admin','60f75fe63b6a38d36341d0a2b309f91f','dome@tel.co.th','a085a6f0be54c113431a23db3c68de55',1,1,'2012-09-26 09:17:29','1970-01-01 00:00:00');
COMMIT;
