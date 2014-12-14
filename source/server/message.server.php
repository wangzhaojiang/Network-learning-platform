<?php
if ($_GET['action'] == 'get_message_list') {
	$start = $_GET['start'];
	$count = $_GET['count'];

	if (!isset($_GET['count'])) {
		$count = 10;
	}
	if (!isset($_GET['start'])) {
		# code...
		$start = 0;
	}

	if ($start > 20) {
		$json_str = '{"status":"false"}';
		echo $json_str;
		exit;
	}

	$message_array = array();
	for ($i = 0; $i <$count; $i++) {
		$number = intval($start)+intval($i);
		$item = array('title'=>'[刷新]自动刷新',
			'content'=>'本条消息为页面下拉异步请求的第' . $number . '条消息。');
		array_push($message_array, $item);
	}

	$json_str = json_encode($message_array);
	echo $json_str;
}
?>