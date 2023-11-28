<?php
/**
* @package CRNRSTN

// J5
// Code is Poetry */
# # C # R # N # R # S # T # N # : : # # # #
#
#        CRNRSTN :: An open source PHP class library supporting enterprise application development that is framed within
#                   the context of mature/rigid RTM protocols.
#        VERSION :: 2.00.0000 PRE-ALPHA-DEV (Lightsaber)
#      TIMESTAMP :: Tuesday, November 28, 2023 @ 16:20:00.065620.
#  DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#         AUTHOR :: Jonathan 'J5' Harris, CEO, CTO, Lead Full Stack Developer.
#            URI :: http://crnrstn.evifweb.com/
#       OVERVIEW :: CRNRSTN :: An Open Source PHP Class Library that stands on top of a robust web services oriented
#                   architecture to both facilitate, augment, and enhance (with stability) the operations of a code base
#                   for a web application across multiple hosting environments.
#
#                   Copyright (C) 2012-2023 eVifweb development.
#    DESCRIPTION :: CRNRSTN :: is an open source PHP class library that will facilitate and spread (via SOAP services)
#                   operations of a web application across multiple servers or environments (e.g. localhost, stage,
#                   preprod, and production). With this tool, data and functionality possessing characteristics that
#                   inherently create distinctions between one environment and another can all be managed through one
#                   framework for an entire application. IP address restrictions, error logging profiles, and database
#                   authentication credentials are a few areas within an application's architecture where
#                   CRNRSTN :: was designed to excel.
#
#                   Once CRNRSTN :: has been configured to support all of a web application's running servers, one can
#                   seamlessly RTM the codebase of the web site without having to modify the configuration to account
#                   for any unique and environmentally specific parameters. Receive the benefit of a robust and polished
#                   framework that will bubble up logs from exception notifications to any output channel (email, hidden
#                   HTML comment, native default,...etc.) of one's own choosing.
#
#                   For example, stand on top of the CRNRSTN :: SOAP services layer to organize and strengthen the
#                   communications architecture of any web application. By supporting many-to-one proxy messaging
#                   relationships between slaves and a master "communications server", CRNRSTN :: can streamline and
#                   simplify the management of web application communications; one can configure everything from SMTP
#                   credentials to the character count for line wrapping in the text versions of multi-part HTML email.
#
#                   This is the "King's Highway" for sending email communications.
#        LICENSE :: MIT
#                   Permission is hereby granted, free of charge, to any person obtaining
#                   a copy of this software and associated documentation files (the
#                   "Software"), to deal in the Software without restriction, including
#                   without limitation the rights to use, copy, modify, merge, publish,
#                   distribute, sublicense, and/or sell copies of the Software, and to
#                   permit persons to whom the Software is furnished to do so, subject to
#                   the following conditions:
#
#                   The above copyright notice and this permission notice shall be
#                   included in all copies or substantial portions of the Software.
#
#                   THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
#                   EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
#                   MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
#                   IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
#                   CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
#                   TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
#                   SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
#
# # C # R # N # R # S # T # N # : : # # # #
#
#  CLASS :: NA
#  VERSION :: NA
#  DATE :: October 4, 2023 @ 1230 hrs.
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: CRNRSTN :: SYSTEM OVERRIDES.   
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#

//
// Monday, September 25, 2023 @ 0415 hrs.
//
// CRNRSTN :: DEFAULTS WINDOWS SYSTEMS TO os_bit_size = (int) 64.
// THEREFORE, IF NEEDED AND UNTIL I CAN GET TESTED WINDOWS COMMANDS,
// PLEASE SET os_bit_size = (int) 32 HERE, FOR WINDOWS.
// WHERE,
//
// NOTE: PASS $os_bit_size, AND CRNRSTN :: WILL RUN @define('CRNRSTN_INTEGER_LENGTH', (int) ($os_bit_size - 1));
// NOTE: LINUX_EXT4 max file size is 2^44 - 1 bytes (16 TiB - 1 bytes).
// NOTE: WINDOWS NTFS MAX VOLUME SIZE IS 2^32 - 1 clusters (256 TiB - 64 KiB). THIS IS
//       WHERE MOST STOP, BUT IN THEORY, NTFS MAX = 2^64 - 1 clusters (1 YiB - 64 KiB).
//       SEE http://www.ntfs.com/ntfs_vs_fat.htm, https://stackoverflow.com/a/466596
// NOTE: ALL CRNRSTN :: SYSTEM MAX FILE SIZE DEFAULTS WILL LEAVE 128 KiB OF SPACE IN MAX SIZE
//       SYSTEM FILES. IF THE FILE IS MOVED TO ANOTHER SERVER, THERE WILL BE ROOM IN THE FILE
//       TO ADD OR MAINTAIN A COMMENT HEADER WITH A CRNRSTN :: META DATA AND FILE ROUTING
//       SIGNATURE ADDED TO THE FILE.
// NOTE: I DO NOT HAVE WINDOWS COMMANDS YET. SO THIS CONFIG METHOD...I SEE IT AS BEING NEEDED.
// TODO :: REMOVE THIS TODO WHEN THE BELOW OVERRIDES ARE ALL IN PLACE. Wednesday, October 4, 2023 @ 1232 hrs.
// config_disk_byte_settings_overrides(
//      $env_key = CRNRSTN_RESOURCE_ALL,
//      $os_bit_size = NULL,
//      $max_write_file_size = NULL,
//      $crnrstn_file_bytes_reserve = NULL,
//      $max_write_volume_size = NULL,
//      $crnrstn_volume_bytes_reserve = NULL
// );
$this->config_disk_byte_settings_overrides(CRNRSTN_RESOURCE_ALL, 64, NULL, NULL, NULL, NULL);

//
// Wednesday, September 27, 2023 @ 2304 hrs.
//
// NOTE: On Linux: The maximum length for a file name is 255 bytes. The maximum combined
//       length of both the file name and path name is 4096 bytes. This length matches
//       the PATH_MAX that is supported by the operating system.
// NOTE: On Windows: The maximum number of bytes for a file name and file path when combined
//       is 6255. However, the file name itself cannot exceed 255 bytes. Furthermore,
//       directory names (including the directory delimiter) within a path are limited to
//       255 bytes. The Unicode representation of a character can occupy several bytes, so
//       the maximum number of characters that a file name might contain can vary.
//
//       When using the open file support feature with VSS, the backup-archive client adds
//       the snapshot volume name to the path of the objects being processed. The resulting
//       path (snapshot volume name plus object path) must adhere to the limits shown. The
//       snapshot volume name can be up to 1024 bytes.
//
// https://www.ibm.com/docs/en/storage-protect/8.1.20?topic=parameters-file-specification-syntax
// Last Updated: 2023-09-14
//
// TODO :: REMOVE THIS TODO WHEN THE BELOW OVERRIDES ARE ALL IN PLACE. Wednesday, October 4, 2023 @ 1233 hrs.
// config_disk_max_item_count_overrides(
//      $env_key = CRNRSTN_RESOURCE_ALL,
//      $max_count_folder_items = NULL,
//      $crnrstn_folder_items_reserve = NULL,
//      $max_count_volume_items = NULL,
//      $crnrstn_volume_items_reserve = NULL,
//      $crnrstn_max_length_filename = NULL,
//      $crnrstn_max_length_filepath = NULL
// );
$this->config_disk_max_item_count_overrides(CRNRSTN_RESOURCE_ALL, NULL, NULL, NULL, NULL, NULL, NULL);

//
// Saturday, September 30, 2023 @ 0210 hrs.
//
// TODO :: REMOVE THIS TODO WHEN THE BELOW OVERRIDES ARE ALL IN PLACE. Wednesday, October 4, 2023 @ 1233 hrs.
// config_database_network_overrides(
//      $env_key = CRNRSTN_RESOURCE_ALL,
//      $crnrstn_soap_services_enabled = NULL,
//      $crnrstn_slow_queries_acceleration_enabled = NULL;
//      $connection_keepalive = NULL,
//      $connection_ttl = NULL,
//
// );
$this->config_database_network_overrides(CRNRSTN_RESOURCE_ALL, NULL, NULL, NULL, NULL);

//
// TODO :: REMOVE THIS TODO WHEN THE BELOW OVERRIDES ARE ALL IN PLACE. Wednesday, October 4, 2023 @ 1233 hrs.
// config_database_throughput_overrides(
//      $env_key = CRNRSTN_RESOURCE_ALL,
//      $crnrstn_query_cache_enabled = NULL,
//      $crnrstn_results_cache_enabled = NULL,
//      $max_allowed_packet = NULL,
//      $max_cache_packet_bytes = NULL,
//      $cache_ttl_packet = NULL,
//      $max_cache_results_bytes = NULL,
//      $cache_ttl_results = NULL
//
// );
$this->config_database_throughput_overrides(CRNRSTN_RESOURCE_ALL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

//
// TODO :: REMOVE THIS TODO WHEN THE BELOW OVERRIDES ARE ALL IN PLACE. Wednesday, October 4, 2023 @ 1233 hrs.
// config_database_shard_overrides(
//      $env_key = CRNRSTN_RESOURCE_ALL,
//      $table_prefix = NULL,
//      $max_table_record_count = NULL,
//      $shard_ttl = NULL
//
// );
$this->config_database_shard_overrides(CRNRSTN_RESOURCE_ALL, NULL, NULL, NULL);

//
// TODO :: REMOVE THIS TODO WHEN THE BELOW OVERRIDES ARE ALL IN PLACE. Wednesday, October 4, 2023 @ 1233 hrs.
// config_electrum_overrides(
//      $env_key = CRNRSTN_RESOURCE_ALL,
//      $max_bytes_throughput = NULL,
//      $max_pid_threads = NULL,
//      $max_conn_ftp = NULL,
//      $ftp_conn_timeout = NULL,
//      $max_cpu_load_percentage = NULL,
//      $max_memory_usage_bytes = NULL,
//      $max_incoming_data_connections,
//      $max_outgoing_data_connections,
//      $ftp_graceful_degrade = NULL        // PERMIT CRNRSTN :: TO USE HTTP GET, CURL POST, OR
//                                             PACKET CHUNKING OVER CRNRSTN :: SOAP SERVICES LAYER
//                                             UPON FTP CONNECTION FAILURE.
//
// );
$this->config_electrum_overrides(CRNRSTN_RESOURCE_ALL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

//
// TODO :: REMOVE THIS TODO WHEN THE BELOW OVERRIDES ARE ALL IN PLACE. Wednesday, October 4, 2023 @ 1234 hrs.
// config_wethrbug_overrides(
//      $env_key = CRNRSTN_RESOURCE_ALL,
//      $default_zipcode = NULL,
//      $forecast_length = NULL,
//      $default_units_celsius = NULL,
//      $database_enabled = NULL
// );
$this->config_wethrbug_overrides(CRNRSTN_RESOURCE_ALL, NULL, NULL, NULL, NULL);