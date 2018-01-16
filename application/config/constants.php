<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


define('ROLE_SUPER_ADMIN',                              '1');
define('ROLE_ADMIN',                                    '2');
define('ROLE_EMPLOYEE',                         	'3');
define('SEGMENT',2);
define('PROJECT_NAME',                                'PMS');
define('PER_PAGE_RECORDS',                              '5');
define ("STATUS_ARRAY",                                     json_encode(array(1=>'Active',2=>'Inactive')));
// define('STATUS_ARRAY',                                  array(1=>'Active',2=>'In Active'));
define('GATE_TYPE_ARRAY',                                  json_encode(array(1=>'Entry',2=>'Exit')));
define('DEVICE_IP_TYPES',                                  json_encode(array(1=>'Company',2=>'Employee')));
define('CUSTOMER_PAID_BY_CASH_OR_CARD_ARRAY',              json_encode(array(1=>'Cash',2=>'Card')));
define('REPORT_PAID_TO_ADMIN',                             json_encode(array(1=>'Generated',2=>'Updated',3=>'Submitted')));
define('MONTHS_FOR_REPORT_ARRAY',                          json_encode(array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December')));
define('YEARS_FOR_REPORT_ARRAY',                           json_encode(array('from_year'=>2017,'to_year'=>2050)));
define('REPORT_TYPE_ARRAY',                                json_encode(array(1=>"Daily",2=>"From Date")));
define('ROLE_PRIVILEGES_ARRAY',                            json_encode(array(   1=>'Master - Shifts',
                                                                               // 2=>'Operator Collection Report',
                                                                              //  3=>'Manual Entry',
                                                                              //  4=>'Device Registry', // Network Monitoring
                                                                              //  5=>'Remaining Vehicles Report',
                                                                                6=>'Shift Report',
                                                                                7=>'Daily Entry Report',
                                                                                8=>'Master - Roles', // Add Role
                                                                                9=>'Daily Exit Report',
                                                                                10=>'Daily Remaining Vehicles Report',
                                                                                11=>'Monthly Report',
                                                                                // 12=>'Ticket Type Report',
                                                                                13=>'Time Based Report',
                                                                                14=>'Summary Report',
                                                                               // 15=>'Add Vehicle',
                                                                               // 16=>'Add Previlege',
                                                                               // 17=>'Daily Remaining Vechiles',
                                                                               // 18=>'Audit Trail Report',
                                                                                19=>'Master - Vendor Companies',
                                                                                20=>'Companywise Report',
                                                                               // 21=>'Update Vendor company details',
                                                                                22=>'Change password',
                                                                                23=>'Entry form',
                                                                                24=>'Administrative Tasks - Users',
                                                                                25=>'Exit form',
                                                                               // 26=>'Duplicate Entry Ticket',
                                                                                27=>'Summary Report For Supervisor',
                                                                            //    28=>'Manual Exit',
                                                                            //    29=>'Manual Exit Report',
                                                                               // 30=>'Add Free Time',
                                                                               // 31=>'Add Category',
                                                                                32=>'Master - Gates', // Add Terminal
                                                                                //33=>'Add Employee' - user already present
                                                                                33=>'Master - Employee Company',
                                                                                34=>'Govt Proof Types',
                                                                                35=>'Master - Prices',
                                                                                36=>'Administrative Tasks - Vehicle Types and Prices',
                                                                                37=>'Administrative Tasks - Gates and Employee',
                                                                                38=>'Cash Management - Report Chart',
                                                                                39=>'Cash Management - Cash Report Summary',
                                                                                40=>'Approve Employee Report',
                                                                                41=>'Cash Management - Cash Collected list',
                                                                                42=>'All Exited list',
                                                                                43=>'My Current Report',
                                                                                44=>'My Submitted Report'
                                                                        )));
define('EXT',                              '');