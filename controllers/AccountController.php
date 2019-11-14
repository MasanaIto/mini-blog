<?php

/**
 * AccountController.
 */
class AccountController extends Controller
{
    public function signupAction()
    {
        return $this->render(array(
            'user_name' => '',
            'password'  => '',
            '_token' => $this->generateCsrfToken('account/signup'),
        ));
    }

    public function registerAction()
    {
        // HTTPメソッドのチェック POST以外のリクエストが来た場合404エラーを返す
        if(!$this->request->isPost()) {
            $this->forward404();
        }

        // CSRFトークンのチェックのチェック
        $token = $this->request->getPost('_token');
        if(!$this->checkCsrfToken('account/signup', $token)) {
            return $this->redirect('/account/signup');
        }

        $user_name = $this->request->getPost('user_name');
        $password = $this->request->getPost('password');

        $errors = array();

        // バリデーション
        if(!strlen($user_name)) {
            $errors[] = 'ユーザーIDを入力してください';
        } else if (!preg_match('/^\w{3,20}$/', $user_name)) {
            $errors[] = 'ユーザーIDは半角英数字及_を3~30文字以内で入力してください';
        } else if (!$this->db_manager->get('User')->isUniqueUserName($user_name)) {
            $errors[] = 'ユーザーIDは既に使用されています';
        }

        if(!strlen($password)) {
            $errors[] = 'パスワードを入力してください';
        } else if (4 > strlen($password) || strlen($password) > 30) {
            $errors[] = 'パスワードは4~30文字以内で入力してください';
        }

        // レコードの登録と取得
        if(count($errors) === 0) {
            // DBへ登録 新規作成したデータを取得してセッションへリダイレクトする
            $this->db_manager->get('User')->insert($user_name, $password);
            $this->session->setAuthenticated(true);

            $user = $this->db_manager->get('User')->fetchByUserName($user_name);
            $this->session->set('user', $user);

            return $this->redirect('/');
        }

        return $this->render(array(
            'user_name' => $user_name,
            'password'  => $password,
            'errors'    => $errors,
            '_token'    => $this->generateCsrfToken('account/signup'),
        ), 'signup');
    }
}
