<?php

/**
 * StatusRepository.
 * 投稿機能
 */
class StatusRepository extends DbRepository
{
    // 投稿された情報を保存する(ユーザーID, 投稿内容)
    public function insert($user_id, $body)
    {
        $now = new DateTime();

        $sql = "
            INSERT INTO status(user_id, body, created_at) VALUES(:user_id, :created_at)
        ";

        $stmt = $this->execute($sql, array(
            ':user_id'  => $user_id,
            ':body'     => $body,
            ':create_at'=> $now->format('Y-m-d H:i:s'),
        ));
    }

    // 現在ログインしているユーザーに関連する投稿を許可する フォローしているユーザーの投稿など
    public function fetchAllArchivesByUserId($user_id)
    {
        $sql = "
            SELECT a.* u.user_name
                FROM status a LEFT JOIN user u ON a.user_id = u.id
                WHERE u.id = :user_id
                ORDER BY a.created_at DESC
        ";

        return $this->fetchAll($sql, array(':user_id' => $user_id));
    }
}