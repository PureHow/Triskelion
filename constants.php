<?php

/**
 *
 * 0 always means success
 *
 */

define('SYS_STATUS_OK', 0);

/**
 *
 * 1xxxxx means System code
 *
 */

define('SYS_STATUS_ERROR_UNKNOW', 100000);

/**
 *
 * 2xxxxx means User code
 *
 */

define('USER_NOT_FOUND', 200001);
define('USER_LOCKED',    200002);
