<?php

namespace App\Constants;

class DBValues
{
    /*
     * DATABASE VALUES STORED AS CONSTANTS '''''  BLOG TABLE  '''''
     */
    const DB_TABLE_NAME_BLOG = "blog";
    const DB_TABLE_BLOG_UID = "uid";
    const DB_TABLE_BLOG_TITLE = "title";
    const DB_TABLE_BLOG_DESCRIPTION = "desc";
    const DB_TABLE_BLOG_AUTHOR = "author_name";
    const DB_TABLE_BLOG_AUTHOR_TYPE = "author_type";
    const DB_TABLE_BLOG_PUBLISHED_DATE = "published_date";
    const DB_TABLE_BLOG_CONTENT = "content";
    const DB_TABLE_BLOG_URL_IMAGE = "url_image";
    const DB_TABLE_BLOG_TAGS = "tags";
    const DB_TABLE_BLOG_PRIORITY = "priority";
    const DB_TABLE_BLOG_FEATURED = "featured";
    const DB_TABLE_BLOG_CATEGORY = "category";
    const DB_TABLE_BLOG_LAST_UPDATED_TIME = "last_updated_time";

    /*
     * DATABASE VALUES STORED AS CONSTANTS '''''  MEDIA TABLE  '''''
     */
    const DB_TABLE_NAME_MEDIA = "media";
    const DB_TABLE_MEDIA_UID = "uid";
    const DB_TABLE_MEDIA_HEADLINE = "headline";
    const DB_TABLE_MEDIA__URL_CONTENT = "url_content";
    const DB_TABLE_MEDIA_MEDIA_NAME = "media_name";
    const DB_TABLE_MEDIA_AUTHOR_NAME = "author_name";
    const DB_TABLE_MEDIA_URL_BACKGROUND_PIC = "url_bg_pic";
    const DB_TABLE_MEDIA_URL_PDF = "url_pdf";
    const DB_TABLE_MEDIA_TAGS = "tags";
    const DB_TABLE_MEDIA_PRIORITY = "priority";
    const DB_TABLE_MEDIA_PUBLISHED_ON_DATE = "published_on_date";
    const DB_TABLE_MEDIA_LAST_UPDATED_TIME = "last_updated_time";

    /*
     * CONSTANT OPERATOR USED IN SQL SYNTAX
     */
    const DB_OPERATOR_SELECT_ALL = "*";
    const DB_OPERATOR_EQUAL_TO = "=";
    const DB_OPERATOR_NOT_EQUAL_TO = "<>";
    const DB_OPERATOR_LIKE = "like";
    const DB_OPERATOR_LIKE_PERCENTAGE = "%";
    const DB_OPERATOR_DECREASING_ORDER = "desc";
}
