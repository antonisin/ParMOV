<?php

/**
 * Created by PhpStorm.
 * User: Maxim Antonisin <antonisin.maxim@gmail.com>
 * Date: 10.07.15
 * Time: 14:23
 */

/**
 * Class MysqlClass
 *
 * @author Maxim Antonisin <antonisin.maxim@gmail.com>
 * @version 0.1.beta
 */
class MysqlClass
{
    /**
     * Mysql host url
     * Setter: setPassword()
     * Getter: getPassword()
     *
     * @access public
     *
     * @var string
     */
    private $host;

    /**
     * Mysql host port
     * Setter: setPort()
     * Getter: getPort()
     *
     * @access public
     *
     * @var integer
     */
    private $port;

    /**
     * Mysql user password
     * Setter: setPassword()
     * Getter: getPasseord()
     *
     * @access public
     *
     * @var string
     */
    private $password;

    /**
     * Mysql user name
     * Setter: setUser()
     * Getter: getUser()
     *
     * @access public
     *
     * @var string
     */
    private $user;

    /**
     * Mysql used database
     * Setter: setDatabase()
     * Getter: getDatabase()
     *
     * @access public
     *
     * @var string
     */
    private $database;

    /**
     * Mysql Resource connection
     * Setter: setConnection()
     * Getter: getConnection()
     *
     * @access public
     *
     * @var mixed/resource
     */
    private $connection;

    /**
     * __construct method
     *
     * @access public
     *
     * @param array $options Parameters for connect to Mysql server
     *                       [
     *                          0 => 'host'
     *                          1 => 'port'
     *                          2 => 'user'
     *                          3 => 'password'
     *                          4 => 'database'
     *                       ]
     *
     *
     * @version 0.1.beta
     */
    public function __construct(array $options)
    {
        $this
            ->setHost($options[0])
            ->setPort($options[1])
            ->setUser($options[2])
            ->setPassword($options[3])
            ->setDatabase($options[4]);
    }

    /**
     * Initialize Mysql connection
     * host - $host
     * port - $port
     * user - $user
     * password - $password
     * database - $database
     *
     * @access private
     *
     * @return mixed/resource
     * @version 0.1.beta
     */
    protected function connect()
    {
        $this->setConnection(
            mysqli_connect(
                $this->getHost() . $this->getPort(),
                $this->getUser(),
                $this->getPassword(),
                $this->getDatabase()
            )
        );

        return $this->getConnection();
    }

    /**
     * Return Mysql host url
     *
     * @access private
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Set Mysql host url
     *
     * @access private
     *
     * @param string $host
     * @return MysqlClass
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Return Mysql host port
     *
     * @access private
     *
     * @return integer
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Set Mysql host port
     *
     * @access private
     *
     * @param integer $port Mysql host port
     * @return MysqlClass
     */
    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * Return Mysql user password
     *
     * @access private
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set Mysql user password
     *
     * @access private
     *
     * @param string $password Mysql user password
     * @return MysqlClass
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Return Mysql user name
     *
     * @access private
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set Mysql user name
     *
     * @access private
     *
     * @param string $user Mysql user name
     * @return MysqlClass
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Return Mysql used database
     *
     * @access private
     *
     * @return string
     */
    public function getDatabase()
    {
        return $this->database;
    }

    /**
     * Set Mysql used database
     *
     * @access private
     *
     * @param string $database Mysql database
     * @return MysqlClass
     */
    public function setDatabase($database)
    {
        $this->database = $database;

        return $this;
    }

    /**
     * Return Mysql connection resource
     *
     * @access private
     *
     * @return mixed/resource
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * Set Mysql resource connection
     *
     * @access private
     *
     * @param mixed $connection Mysql resource connection
     * @return MysqlClass
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;

        return $this;
    }
}