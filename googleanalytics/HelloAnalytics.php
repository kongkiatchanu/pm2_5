<?php
// Load the Google API PHP Client Library.
require_once '/home/pm25/public_html/vendor/autoload.php';
echo 'load' .$_SERVER['DOCUMENT_ROOT'];

$analytics = initializeAnalytics();
$response = getReport($analytics);
print_r($response);
exit;
printResults($response);


/**
 * Initializes an Analytics Reporting API V4 service object.
 *
 * @return An authorized Analytics Reporting API V4 service object.
 */
function initializeAnalytics()
{

  // Use the developers console and download your service account
  // credentials in JSON format. Place them in this directory or
  // change the key file location if necessary.
  $KEY_FILE_LOCATION = __DIR__ . '/service-account-credentials.json';

  // Create and configure a new client object.
  $client = new Google_Client();
  $client->setApplicationName("Hello Analytics Reporting");
  $client->setAuthConfig($KEY_FILE_LOCATION);
  $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
  $analytics = new Google_Service_AnalyticsReporting($client);

  return $analytics;
}


/**
 * Queries the Analytics Reporting API V4.
 *
 * @param service An authorized Analytics Reporting API V4 service object.
 * @return The Analytics Reporting API V4 response.
 */
function getReport($analytics) {

  // Replace with your view ID, for example XXXX.
  $VIEW_ID = "203809544";

  // Create the DateRange object.
  $dateRange = new Google_Service_AnalyticsReporting_DateRange();
/*  $dateRange->setStartDate("7daysAgo");
  $dateRange->setEndDate("today");*/
  $dateRange->setStartDate("2019-01-01");
  $dateRange->setEndDate("today");

  // Create the Metrics object.
  $users = new Google_Service_AnalyticsReporting_Metric();
  $users->setExpression("ga:users");
  $users->setAlias("Users");

  $onedayusers = new Google_Service_AnalyticsReporting_Metric();
  $onedayusers->setExpression("ga:1dayUsers");
  $onedayusers->setAlias("onedayusers");

  $sevendayusers = new Google_Service_AnalyticsReporting_Metric();
  $sevendayusers->setExpression("ga:7dayUsers");
  $sevendayusers->setAlias("sevendayusers");

  $thirtydayusers = new Google_Service_AnalyticsReporting_Metric();
  $thirtydayusers->setExpression("ga:30dayUsers");
  $thirtydayusers->setAlias("thirtydayusers");

  $sessions = new Google_Service_AnalyticsReporting_Metric();
  $sessions->setExpression("ga:sessions");
  $sessions->setAlias("Sessions");

  $pageviews = new Google_Service_AnalyticsReporting_Metric();
  $pageviews->setExpression("ga:pageviews");
  $pageviews->setAlias("Page Views");

  // Create the ReportRequest object.
  $request = new Google_Service_AnalyticsReporting_ReportRequest();
  $request->setViewId($VIEW_ID);
  $request->setDateRanges($dateRange);
  $request->setMetrics(array($users, $sessions, $pageviews));

  $body = new Google_Service_AnalyticsReporting_GetReportsRequest();
  $body->setReportRequests( array( $request) );
  return $analytics->reports->batchGet( $body );
}


/**
 * Parses and prints the Analytics Reporting API V4 response.
 *
 * @param An Analytics Reporting API V4 response.
 */
function printResults($reports) {
  for ( $reportIndex = 0; $reportIndex < count( $reports ); $reportIndex++ ) {
    $report = $reports[ $reportIndex ];
    $header = $report->getColumnHeader();
    $dimensionHeaders = $header->getDimensions();
    $metricHeaders = $header->getMetricHeader()->getMetricHeaderEntries();
    $rows = $report->getData()->getRows();

    for ( $rowIndex = 0; $rowIndex < count($rows); $rowIndex++) {
      $row = $rows[ $rowIndex ];
      $dimensions = $row->getDimensions();
      $metrics = $row->getMetrics();
      for ($i = 0; $i < count($dimensionHeaders) && $i < count($dimensions); $i++) {
        print($dimensionHeaders[$i] . ": " . $dimensions[$i] . "\n");
      }

      for ($j = 0; $j < count($metrics); $j++) {
        $values = $metrics[$j]->getValues();
        for ($k = 0; $k < count($values); $k++) {
          $entry = $metricHeaders[$k];
          print($entry->getName() . ": " . $values[$k] . " | ");
        }
      }
    }
  }
}
