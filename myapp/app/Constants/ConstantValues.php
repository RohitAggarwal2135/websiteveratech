<?php

namespace App\Constants;

class ConstantValues
{
    /*
     * CONSTANT "VALUES" USED ACROSS THE WEBSITE
     */
    const FIELD_NAME_ID = "id";
    const FIELD_NAME_LIMIT = "limit";
    const FIELD_NAME_OFFSET = "offset";

    /*
     * CONSTANT "HELPER VALUES" USED ACROSS THE WEBSITE
     */
    const FIELD_NAME_REQUIRED = "required";
    const FIELD_NAME_INTEGER = "integer";
    const FIELD_NAME_BETWEEN = "between";

    /*
     * CONSTANT "ERROR MESSAGES" USED ACROSS THE WEBSITE
     */
    const FIELD_NAME_ID_IS_MISSING = "id is missing";
    const FIELD_NAME_LIMIT_IS_MISSING = "limit is missing";
    const FIELD_NAME_LIMIT_NOT_INTEGER = "limit must be an integer";
    const FIELD_NAME_LIMIT_NOT_BETWEEN = "limit too high";
    const FIELD_NAME_OFFSET_IS_MISSING = "offset is missing";
    const FIELD_NAME_OFFSET_NOT_INTEGER = "offset must be an integer";

    /*
     * CONSTANT "OPERATOR" USED ACROSS THE WEBSITE
     */
    const FIELD_NAME_OPERATOR_COLON = ":";
    const FIELD_NAME_OPERATOR_DOT = ".";
    const FIELD_NAME_OPERATOR_VERTICAL_BAR = "|";
    const FIELD_NAME_OPERATOR_QUOTE = "'";

    /*
     * CONSTANT HEADER USED IN RESPONSE
     */
    const HEADER_NAME_CORS = "Access-Control-Allow-Origin"; // HEADER USED FOR CROSS-ORIGIN REQUEST BLOCKED
    const  HEADER_VALUE_ALL_OPERATOR = "*";
}
