<?php

class actionAdminUsersFilter extends cmsAction {

    public function run($group_id){

        $content_model = cmsCore::getModel('content')->setTablePrefix('');

        $ctype = $content_model->getContentTypeByName('users');

        $fields  = $content_model->getContentFields('users');

        $fields[] = array(
            'title' => LANG_RATING,
            'name' => 'rating',
            'handler' => new fieldNumber('rating')
        );

        $fields[] = array(
            'title' => LANG_KARMA,
            'name' => 'karma',
            'handler' => new fieldNumber('karma')
        );

        $fields[] = array(
            'title' => LANG_USER_IS_ADMIN,
            'name' => 'is_admin',
            'handler' => new fieldCheckbox('is_admin')
        );

		$fields = cmsEventsManager::hook('admin_users_filter', $fields);

        return cmsTemplate::getInstance()->render('users_filter', array(
            'ctype' => $ctype,
            'fields' => $fields
        ));

    }

}
