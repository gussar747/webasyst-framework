<?php

class blogFrontendOauthAction extends waViewAction
{
    public function execute()
    {
        $provider = waRequest::param('provider');
        $this->view->assign('provider', $provider);

        $refresh = 0;
        $auth_user_data = wa()->getStorage()->get('auth_user_data');
        if ($auth_user_data && $auth_user_data['source'] == $provider) {
            $refresh = 1;
        } else {
            wa()->getStorage()->del('auth_user_data');
        }
        $this->view->assign('refresh', $refresh);
        $this->setLayout(new blogFrontendLayout());
        $this->setThemeTemplate('oauth.html', waRequest::param('theme', 'default'));
    }
}