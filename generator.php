<?php
/**
 * Скрипт сделан на основе оригинального скрипта https://github.com/AndreyGo/SublimeBitrixSnippets
 *
 * Генерируем сниппеты быстрой вставки компонентов для sublimetext
 * Положить скрипт в корень сайта и запустить
 *
 */
include $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include.php';

$comPath = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/components/bitrix/';
$comUtil = new CComponentUtil();

// Папка со сниппетами, относительно корня сайта
$folderName = '/snippets/';

$snippetsDir = $_SERVER['DOCUMENT_ROOT'] . $folderName;

// Компоненты, которые нафиг не нужны
$skip = array
(
	'desktop', 'socialnetwork.user_settings_edit', 'socialnetwork.events_dyn', 'socialnetwork.subscribe', 'socialnetwork.bizproc_edit', 'socialnetwork.forum.topic.last', 'socialnetwork.forum.topic.new', 'socialnetwork.forum.post_form', 'socialnetwork.messages_chat', 'socialnetwork.group_list', 'socialnetwork.group_requests.ex', 'socialnetwork.group_users', 'socialnetwork.messages_users_messages', 'socialnetwork.blog.draft', 'socialnetwork.bizproc', 'socialnetwork.group_ban', 'socialnetwork.user_search_input', 'socialnetwork.user_groups', 'socialnetwork.group', 'socialnetwork.group_delete', 'socialnetwork', 'socialnetwork.subscribe_list', 'socialnetwork.blog.post', 'socialnetwork.user_birthday', 'socialnetwork.user_ban', 'socialnetwork.messages_requests', 'socialnetwork.user_request_group', 'socialnetwork.user_search', 'socialnetwork.messages_menu', 'socialnetwork.blog.post.edit', 'socialnetwork.group_mods', 'socialnetwork.user_friends.ex', 'socialnetwork.group_request_user', 'socialnetwork.log.entry', 'socialnetwork_user', 'socialnetwork.group_top', 'socialnetwork.user_friends_delete', 'socialnetwork.features', 'socialnetwork.blog.blog', 'socialnetwork.blog.rss', 'socialnetwork.user_friends_add', 'socialnetwork.messages_output', 'socialnetwork.blog.post.comment', 'socialnetwork.log.rss', 'socialnetwork.forum.topic.read', 'socialnetwork.group_requests', 'socialnetwork.group_create', 'socialnetwork.forum.topic.list', 'socialnetwork.messages_input', 'socialnetwork.blog.menu', 'socialnetwork.group_requests_out', 'socialnetwork.user_menu', 'socialnetwork.user_profile_edit', 'socialnetwork_group', 'socialnetwork.group_search', 'socialnetwork.user_friends', 'socialnetwork.group_request_search', 'socialnetwork.group_users.ex', 'socialnetwork.user_requests.ex', 'socialnetwork.user_profile', 'socialnetwork.group_menu', 'socialnetwork.log.ex', 'socialnetwork.messages_users', 'socialnetwork.user_leave_group', 'socialnetwork.blog.moderation', 'socialnetwork.activity', 'socialnetwork.events', 'socialnetwork.message_form', 'bizproc.wizards', 'subscribe.edit', 'forum.topic.read', 'forum.message.move', 'forum.user.profile.edit', 'forum.topic.new', 'forum.pm.folder', 'forum.user.post', 'forum.topic.last', 'forum.topic.active', 'forum.search', 'forum.message.send', 'forum.pm.list', 'forum.statistic', 'forum.index', 'forum', 'forum.message.approve', 'forum.subscribe.list', 'forum.pm.edit', 'forum.user.list', 'forum.post_form', 'forum.topic.reviews', 'forum.help', 'forum.rules', 'forum.topic.list', 'forum.topic.search', 'forum.pm.read', 'forum.rss', 'forum.comments', 'forum.topic.move', 'forum.user.profile.view', 'forum.pm.search', 'blog.post.trackback.get', 'blog.blog.edit', 'blog.post.comment', 'blog.rss.all', 'blog.search', 'blog.blog.draft', 'blog.category', 'blog.groups', 'blog.friends', 'blog.new_comments', 'blog.post.trackback', 'blog.new_posts.list', 'blog.user', 'blog.rss.link', 'blog.blog.favorite', 'blog.post.edit', 'blog.post', 'blog.commented_posts', 'blog.user.settings', 'blog.blog.moderation', 'blog.menu', 'blog.new_posts', 'blog.group.blog', 'blog.user.group', 'blog.user.settings.edit', 'blog.info', 'blog.calendar', 'blog.rss', 'blog.blog', 'blog.new_blogs', 'blog.popular_blogs', 'blog', 'blog.popular_posts', 'sale.personal.order.detail', 'sale.viewed.product', 'sale.affiliate.instructions', 'sale.personal.order', 'sale.personal.profile.list', 'sale.ajax.delivery.calculator', 'sale.notice.product', 'sale.ajax.locations', 'sale.basket.basket.line', 'sale.personal.subscribe.cancel', 'sale.personal.subscribe.list', 'sale.affiliate.report', 'sale.personal.order.cancel', 'sale.basket.basket', 'sale.account.pay', 'sale.affiliate.register', 'sale.personal.cc.detail', 'sale.personal.account', 'sale.export.1c', 'sale.order.ajax', 'sale.personal.cc', 'eshop.sale.basket.basket', 'sale.order.full', 'sale.basket.order.ajax', 'sale.personal.profile', 'sale.personal.cc.list', 'sale.bestsellers', 'sale.order.payment.receive', 'sale.affiliate.account', 'sale.basket.basket.small', 'sale.recommended.products', 'sale.personal.order.list', 'sale.personal.subscribe', 'sale.personal.profile.detail', 'sale.affiliate.plans', 'learning.course.detail', 'learning.search', 'learning.student.gradebook', 'learning.test.list', 'learning.course.list', 'learning.test', 'learning.lesson.detail', 'learning.course.tree', 'learning.test.self', 'learning.course.contents', 'learning.course', 'learning.student.profile', 'learning.student.transcript', 'learning.student.certificates', 'learning.chapter.detail', 'photogallery.gallery.list', 'photogallery.imagerotator', 'photogallery.detail.list', 'photogallery.user', 'photogallery.section.list', 'photogallery', 'photogallery.detail.edit', 'photogallery.section', 'photogallery.gallery.edit', 'photogallery.upload', 'photogallery.section.edit.icon', 'photogallery.detail', 'photogallery.detail.comment', 'photogallery.section.edit', 'photogallery_user', 'photogallery.detail.list.ex', 'photo.section', 'photo.random', 'photo.sections.top', 'photo.detail', 'photo', 'furniture.catalog.index', 'furniture.vacancies', 'furniture.catalog.random', 'news.calendar', 'main.calendar', 'calendar.livefeed.view', 'calendar.events.list', 'calendar.grid', 'calendar.livefeed.edit', 'lists.menu', 'lists.list', 'lists.lists', 'lists.element.edit', 'lists.field.edit', 'lists', 'lists.list.edit', 'lists.file', 'lists.element.navchain', 'lists.fields', 'lists.sections', 'eshop.menu.sections', 'eshop.catalog.top', 'search.tags.cloud', 'search.tags.input', 'search.title', 'wiki.menu', 'wiki.history.diff', 'wiki.history', 'wiki.categories', 'wiki.show', 'wiki', 'wiki.discussion', 'wiki.category', 'wiki.edit', 'main.share', 'mobileapp.colorpicker'
);
$snippet = '';
/**
 * Функция для установки правильного окончания слов (просто для красоты)
 * @param int $n - число, для которого будет расчитано окончание
 * @param string $words - варианты окончаний для (1 комментарий, 2 комментария, 100 комментариев)
 * @return string - слово с правильным окончанием
 */
function wordSpan($n = 0, $words) {
	$words = explode('|', $words);
	$n     = intval($n);
	return $n % 10 == 1 && $n % 100 != 11 ? $words[0] . $words[1] : ($n % 10 >= 2 && $n % 10 <= 4 && ($n % 100 < 10 || $n % 100 >= 20) ? $words[0] . $words[2] : $words[0] . $words[3]);
}

if (is_dir($comPath)) {
	if ($h = opendir($comPath)) {
		$i      = '0';
		$output = '';
		while (($file = readdir($h)) !== false) {

			if ($file == '..' | $file == '.') {
				continue;
			}

			if (!file_exists($comPath . $file . '/.parameters.php')) {
				continue;
			}
			if (in_array($file, $skip)) {
				continue;
			} else {
				$i++;
			}

			$param = $comUtil->GetComponentProps('bitrix:' . $file);
			$comUtil->PrepareVariables($param);

			if (!is_array($param['PARAMETERS']) | count($param) == 0) {
				continue;
			}

			$snippetName = 'bitrix-' . $file . '.sublime-snippet';
			$snippet     = "<snippet>" . "\n" . "  <content>" . "<![CDATA[" . "\n" . '<?\$APPLICATION->IncludeComponent("bitrix:' . $file . '", "${1:.default}", Array(' . "\n";

			$count = 2;
			foreach ($param['PARAMETERS'] as $name => $value) {
				$default = trim($value['DEFAULT']);

				if (substr_count($default, '$') > 0) {
					$default = str_replace('$', '\$', $default);
				}

				if ($default == '') {
					$default = '"${' . $count . ':}"';
				} elseif (substr_count($default, '{') > 0) {
					$default = str_replace(array(
						'{',
						'}',
						'=',
					), array(
						'',
						'',
						'',
					), $default);
					$default = '${' . $count . ':' . $default . '}';
				} else {
					$default = '"${' . $count . ':' . $default . '}"';
				}

				$snippet .= '	"' . $name . '" => ' . $default . ',		// ' . $value['NAME'] . "\n";
				$count++;
			}
			$tabTrigger = 'bx_' . str_replace('.', '_', $file);
			$snippet .= '	),' . "\n" . '	false' . "\n" . ');?>' . "\n${0}" . ']]></content>' . "\n" . '<tabTrigger>' . $tabTrigger . '</tabTrigger>' . "\n" . '<description>Bitrix ' . $file . '</description>' . "\n" . '</snippet>';

			if (file_exists($snippetsDir . $snippetName)) {
				unlink($snippetsDir . $snippetName);
			}
			file_put_contents($snippetsDir . $snippetName, $snippet);
			unset($param);
			$snippet    = '';
			$tabTrigger = '';
			$output .= '<li><a href="' . $folderName . $snippetName . '" target="_blank">bitrix:' . $file . '</a></li>';
		}
		closedir($h);
		$e = $i - 1;
		echo wordSpan($e, ' Сгенерирова|н|но|но') . ': <b>' . $e . '</b>' . wordSpan($e, ' сниппе|т|та|тов');
		echo '<ol>' . $output . '</ol>';
		echo '<hr /><b>Исключены:</b> <br />' . implode('<br />', $skip);
	}
} else {
	echo 'Wrong Components dir "' . $comPath . '"';
}

?>