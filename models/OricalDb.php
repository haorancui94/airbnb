<?php

/*
* 更新oracle库的数据到mysql中
*/

namespace app\models;

use yii\db\ActiveRecord;

class OricalDb extends ActiveRecord
{
    /**
     * 获取一个连接
     */
    private function getConn()
    {
        $db_conf = \Yii::$app->params['orical_db'];
        try {
            $conn = oci_connect($db_conf['oracle_name'], $db_conf['oracle_pwd'], $db_conf['oracle_address'], 'UTF8');
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            exit;
        }
        if (!$conn) {
            $e = oci_error();
            throw new Exception('oracle链接失败-' . $e['message'], 0);
        }
        return $conn;
    }

	/**
	 * 获取用户信息
	 * @param string $attributes
	 * @param string $file
	 * @param string $value
	 * @return array|void
	 */
    public function getUserByFile($attributes='', $file = '', $value='')
    {
        if (empty($file) || empty($value)) {
            return '';
        }
        $sql = "select {$attributes} from USERS where {$file}='{$value}'";
        $conn = $this->getConn();
        $stid = oci_parse($conn, $sql);
        try {
            $r = oci_execute($stid, OCI_DEFAULT);
            $list = array();
			$attr_arr = explode(',', $attributes);
            while ($row = oci_fetch_array($stid, OCI_NUM + OCI_RETURN_NULLS)) {
            	foreach ($attr_arr as $k=>$v){
            		$list[$v] = $row[$k];
				}
            }
            oci_free_statement($stid);
            oci_close($conn);
            return $list;
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            exit;
        }
    }

    public function saveUser($username='', $password='')
	{
		if (empty($username) || empty($password)) {
			return false;
		}
		$sql = "insert into USERS(email,password) values('{$username}','{$password}')";
		$conn = $this->getConn();
		$stid = oci_parse($conn, $sql);
		try {
			$r = oci_execute($stid);
			oci_free_statement($stid);
			oci_close($conn);
			return $r?true:false;
		} catch (\Exception $exception) {
			echo $exception->getMessage();
			exit;
		}
	}
}
