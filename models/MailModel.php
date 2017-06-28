<?php

namespace app\models;

use app\modules\admin\models\MailAdressModel;

use Swift_Plugins_LoggerPlugin;
use Swift_Plugins_Loggers_ArrayLogger;

use Yii;
use yii\base\Model;
use yii\swiftmailer\Mailer;

class MailModel extends Model
{

    public $body;
    public $mailer;
    public $main_par;

    public $param = [
        'senderEmail' => '',
        'informEmail' => '',
        'informName' => '-------',
        'informSubject' => '',
        'body' => '<h2>Здесь купленные товары</h2>'
    ];

    function init()
    {
        parent::init();
        $this->mailer = new Mailer();
        $this->mailer->transport = $this->main_par = MailSettingModel::getSetting();
        //$this->mailer->transport = MailSettingModel::getSetting();
    }

    /**
     * @param array $param
     *
     * @return bool
     */
    function send($img = '')
    {

        //echo 'Body - '.$this->body.'<br><pre>'; var_dump($this->param); die;

        $result = $this->mailer->compose()
            ->setTo($this->param['informEmail'])
            //->setFrom([$this->param['senderEmail'] => $this->param['informName']])
            ->setFrom([$this->main_par['username'] => $this->param['informName']])
            ->setSubject($this->param['informSubject'])
            //->setTextBody($this->param['body']);
            ->setHtmlBody($this->param['body']);
        //->send();
        if ($img != '') $result->attach($img);

        $logger = new Swift_Plugins_Loggers_ArrayLogger();
        $this->mailer->getSwiftMailer()->registerPlugin(new Swift_Plugins_LoggerPlugin($logger));

        if (!$result->send()) {//Перехват ошибки в SiteController - actionError
            echo $logger->dump();
            echo '<br>===================================<br>ERROR - <pre>';
            var_dump($logger);
            die;
        }
        return $result;
    }

    public function sendRegistration($user, $ori_pasw)
    {
        //echo '<pre>'; var_dump($user); die;
        $model = new MailAdressModel();
        $result = $model->getForGroup('manager');

        if (is_null($result)) {
            $this->send();
            return;
        }
        $adress = [];
        $adress[] = $user->email;

        //$informSubject = date('H:i:s', time()) . ' - NIRAX: База кроссов. Подтверждение регистрации.';
        $informSubject = date('H:i:s', time()) . ' -  База кроссов. Подтверждение регистрации.';

        $body = '<div>
                <p>
                Здравствуйте, <b>' . $user->name . '</b>
                </p>
                <p>
                Учетная запись <b>' . $user->username . '</b><br>
                E-mail <b>' . $user->email . '</b><br>
                Пароль  <b>' . $ori_pasw . '</b><br>
                успешно зарегистрирована.<br>
                </p>
                <p>
                Для подтверждения и активации этой учетной записи, пожалуйста, перейдите по ссылке:<br>
                <i><b>http://web.ua/api/confirmation.html?id=58&login=Zapchasti</b></i>
                </p>
                <p>
                Если это письмо попало к вам случайно, то просто удалите его.
                </p>
                <p>
                С уважением, Служба поддержки
                  www.ggg.ua
                  Email: support@ggg.ua
                </p>
        </div>';

        $this->param['body'] = $body;
        $this->param['informEmail'] = $adress;
        $this->param['informSubject'] = $informSubject;
        $this->send();
    }

    /*
        public function sendPrise($ProductPrice,$Comments){
            $model = new MailAdressModel();
            $result = $model->getForGroup('manager');

            if(is_null($result)){
                $this->send();
                return;
            }
            $adress = [];
            foreach($result as $tmp){
                $adress[] =  $tmp->email;
            }

            $str = '<div>------------------------------------<br>';
            $mas = explode(';',$Comments);
            foreach($mas as $item){
                $str .= $item.'<br>';
            }
            $str .= '<table border="1" style="border-collapse: collapse; padding: 5px;"><tr>';
            $str .= '<td>Код<br>Артикул</td>';
            $str .= '<td style="width: 350px;">Наименование</td>';
            $str .= '<td>Кол.</td>';
            $str .= '<td>Склад<br>Поставщик</td>';
            $str .= '<td>Цена</td>';
            $str .= '<td>Прим.</td>';
            $str .= '</tr>';
            foreach($ProductPrice as $item){
                $str .= '<tr>';
                $str .= '<td>'.$item['Code'].'<br>'.$item['CatNumber'].'</td>';
                $str .= '<td><b>'.$item['Brand'].'</b><br>'.$item['Name'].'</td>';
                $str .= '<td>'.$item['Count'].'</td>';
                $str .= '<td>'.$item['StrgName'].'<br>'.$item['SuplName'].'<br>'.$item['StrgTime'].'</td>';
                $str .= '<td>'.$item['Price'].'</td>';
                $str .= '<td>'.$item['Comment'].'</td>';
                $str .= '</tr>';
            }
            $str .= '</div>';

            $this->param['body'] = $str;
            $this->param['informEmail'] = $adress;
            $this->param['informSubject'] = date('H:i:s',time()).' - Уведомление о заказе товара из ПРАЙС-ЛИСТА';
            $this->send();
        }
        public function sendReviewCardGoods($post){
            $model = new MailAdressModel();
    //        var_dump($post); die;
            $result = $model->getForGroup('admin');

            if(is_null($result)){
                $this->send();
                return;
            }
            $adress = [];
            foreach($result as $tmp){
                $adress[] =  $tmp->email;
            }

            $str = 'Написан новый отзыв на товар.<br>';
            $str .= 'Артикул '.$post['article'].'.<br>';
            $str .= 'Бренд '.$post['brand'].'.<br>';
            $str .= 'Товар '.$post['goods_id'].'.<br>';
            $str .= 'Код пользователя '.$post['user_id'].'.<br>';
            $str .= 'Текст '.$post['txt'].'.<br>';

            $this->param['body'] = $str;
            $this->param['informEmail'] = $adress;
            $this->param['informSubject'] = date('H:i:s',time()).' - Уведомление о добавлении отзыва на товар.';
            $this->send();
        }
        public function sendClientMail($adress,$title,$str,$img=''){
            $this->param['body'] = $str;
            $this->param['informEmail'] = $adress;
            $this->param['informSubject'] = date('H:i:s',time()).$title;
            $this->send($img);
        }

        public function getOpponentMail(){
            $model = new MailAdressModel();
            $result = $model->getForGroup('opponetLog');

            if(is_null($result)){
                $this->send();
                return;
            }
            $adress = [];
            foreach($result as $tmp){
                $adress[] =  $tmp->email;
            }
            $this->param['informEmail'] = $adress;
            $this->param['informSubject'] = date('H:i:s',time()).'- Уведомление о входе конкурента!!!';

            $this->send();
        }

        public function getOutherMail(){
            $model = new MailAdressModel();
            $result = $model->getForGroup('outherLog');

            if(is_null($result)){
                $this->send();
                return;
            }
            $adress = [];
            foreach($result as $tmp){
                $adress[] =  $tmp->email;
            }
            $this->param['informEmail'] = $adress;
            $this->param['informSubject'] = date('H:i:s',time()).'- Уведомление о входе c учетной записи другого пользователя!!!';
            $this->send();
        }
    */
}