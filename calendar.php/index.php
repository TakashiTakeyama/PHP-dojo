<?php

require 'Calender.php';

function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

$cal = new \calender.php\Calendar();


try {
  if (!isset($_GET['t']) || !preg_match('/\A\d{4}-\d{2}\z/', $_GET['t'])) {
    throw new Exception();
  }
  $thisMonth = new DateTime($_GET['t']);
} catch (Exception $e) {
  $thisMonth = new DateTime('first day of this month');
}

$dt = clone $thisMonth;
$prev = $dt->modify('-1 month')->format('Y-m');
$dt = clone $thisMonth;
$next = $dt->modify('+1 month')->format('Y-m');

// $thisMonth = new DateTime($__GET['t']);
// $t = '2015-08';
// $thisMonth = new DateTime($t);
$yearMonth = $thisMonth->format('F Y');

$tail = '';
$lastDayOfPrevMonth = new DateTime('last day of ' . $yearMonth . ' -1 month');
while ($lastDayOfPrevMonth->format('w') < 6) {
  $tail = sprintf('<td class="gray">%d</td>', $lastDayOfPrevMonth->format('d')) . $tail;
  $lastDayOfPrevMonth->sub(new DateInterval('P1D'));
}
$body = '';
$period = new DatePeriod(
  new DateTime('first day of' . $yearMonth),
  new DateInterval('P1D'),
  new DateTime('first day of' . $yearMonth . ' +1 month')
);

$today = new DateTime('today');
foreach ($period as $day) {
  if ($day->format('w') % 7 === 0) {
    $body .= '</tr><tr>';
    $todayClass = ($day->format('Y-m-d') === $today->format('Y-m-d')) ? 'today' : '';
  }
  /* format()メソッドは DateTimeオブジェクトで使える書式*/
  $body .= sprintf('<td class="youbi_%d %s">%d</td>',
  $day->format('w'),
  $todayClass,
  $day->format('d'));
}

$head = '';
$firstDayOfNextMonth = new DateTime('first day of ' . $yearMonth . ' +1 month');
while ($firstDayOfNextMonth->format('w') > 0) {
  $head .= sprintf('<td class="gray">%d</td>', $firstDayOfNextMonth->format('d'));
  $firstDayOfNextMonth->add(new DateInterval('P1D'));
}

$html = '<tr>' . $tail . $body . $head . '</tr>';
?>


<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>Calendar</title>
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
      <table>
        <thead>
          <tr>
            <th><a href="/?t=<?php echo h($cal->prev); ?>">&laquo;</a></th>
            <th colspan="5"><?php echo h($cal->yearMonth); ?><?php echo $yearMonth; ?></th>
            <th><a href="/?t=<?php echo h($cal->next); ?>">&raquo;</a></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Sun</td>
            <td>Mon</td>
            <td>Tue</td>
            <td>Wed</td>
            <td>Thu</td>
            <td>Fri</td>
            <td>Sat</td>
          </tr>
          <?php echo $cal->show(); ?>
          <!-- <tr> -->
            <!-- <?php echo $tail . $body . $head; ?> -->
            <!-- <td class="youbi_0">1</td>
            <td class="youbi_1">2</td>
            <td class="youbi_2">3</td>
            <td class="youbi_3">4</td>
            <td class="youbi_4 today">5</td>
            <td class="youbi_5">6</td> 
            <td class="youbi_6">8</td>-->
          <!-- </tr>
          <tr>
            <td class="youbi_0">30</td>
            <td class="youbi_1">31</td>
            <td class="gray">1</td>
            <td class="gray">2</td>
            <td class="gray">3</td>
            <td class="gray">4</td>
            <td class="gray">5</td> -->
          <!-- </tr> -->
          </tbody>
          <tfoot>
            <tr>
              <th colspan="7"><a href="/">Today</a></th>
            </tr>
          </tfoot>
      </table>
    </body>
</html>