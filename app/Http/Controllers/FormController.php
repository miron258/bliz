<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FormController;
use App\Models\Form;
use App\Models\Admin\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FormController extends Controller
{


    public function saveCallback(Request $request)
    {

        $params = $request->all(); //Все данные с инпутов формы
        $validation = Validator::make($params, [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'fields' => [
                    'name' => '',
                    'address' => '',
                    'phone' => ''
                ],
                'messages' => $validation->errors(),
            ], 200);
        } else {
            $form = new Form;
            $form->name = $params['name'];
            $form->phone = $params['phone'];
            $form->type_form = 'callback';
            $form->save();


            //Формируем объект сообщения
            $message = array();
            $message['subject'] = "Форма обратной связи";
            $message['name'] = $params['name'];
            $message['phone'] = $params['phone'];


            //Отправляем сообщения на почту менеджеру
            $this->sendMail($message, 'message-callback');


            return response()->json([
                'success' => true,
                'messageText' => $message,
                'message' => 'Спасибо за заказ звонка.',
                'form' => '',
            ], 200);
        }
    }

    public function saveFormOrder(Request $request)
    {
        $params = $request->all(); //Все данные с инпутов формы

        $messages = $this->getMessages();


        $validation = Validator::make($params, [
            'phone' => 'required|phone:US,RU,BE',
            'address' => 'required',
            'name' => 'required|min:3'
        ], $messages);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validation->errors(),
                'message' => 'Форма не отправлена'
            ], 200);
        } else {
            $form = new form;
            $form->address = isset($params['address']) ? $params['address'] : '';
            $form->phone = isset($params['phone']) ? $params['phone'] : '';
            $form->type_form = 'formorder';
            $form->name = isset($params['name']) ? $params['name'] : '';
            $form->save();


            //Формируем объект сообщения
            $message = array();
            $message['subject'] = "Форма заказа точного расчета стоимости";
            $message['address'] = $params['address'];
            $message['name'] = $params['name'];
            $message['phone'] = $params['phone'];
            //Отправляем сообщения на почту менеджеру
            $this->sendMail($message, 'message-formorder');


            return response()->json([
                'success' => true,
                'errors' => '',
                'message' => 'Спасибо за заказ, наш менеджер свяжется с Вами в ближайшее время.',
                'form' => '',
            ], 200);
        }
    }

    public function saveFormReview(Request $request)
    {
        $params = $request->all(); //Все данные с инпутов формы
        $messages = $this->getMessages();

        $validation = $request->validate([
            'review' => 'required|min:3',
            'address' => 'required|min:3',
            'name' => 'required|min:3',
            'phone' => 'required|phone:US,RU,BE',
        ], $messages);


        $review = new Review;
        $review->address = isset($params['address']) ? $params['address'] : '';
        $review->phone = isset($params['phone']) ? $params['phone'] : '';
        $review->text = isset($params['review']) ? $params['review'] : '';
        $review->name = isset($params['name']) ? $params['name'] : '';
        $review->hidden = 0;
        $review->save();


        //Формируем объект сообщения
        $message = array();
        $message['subject'] = "Форма добавления отзыва";
        $message['address'] = $params['address'];
        $message['name'] = $params['name'];
        $message['review'] = $params['review'];
        $message['phone'] = $params['phone'];


        //Отправляем сообщения на почту менеджеру
        $this->sendMail($message, 'message-formreview');

        return response()->json([
            'success' => true,
            'message' => 'Спасибо за ваш отзыв.',
        ], 200);


    }


    protected function getMessages()
    {
        return $messages = [
            'phone' => 'Неправильный формат номера телефона',
            'phone.required' => 'Поле телефон обязательно для заполнения.',
            'address.required' => 'Поле адрес бурения обязательно для заполнения.',
            'name.required' => 'Поле имя обязательно для заполнения.',
            'review.required' => 'Поле отзыв обязательно для заполнения.',
            'phone.regex' => 'Неправильный формат номера телефона'
        ];
    }

    protected function sendMail($message = '', $template = 'message-callback')
    {
        Mail::send("emails.{$template}", $message, function ($m) {
            $m->from('info@burenie57.com', 'Бурение скважин в Орле');
            $m->to('destinyhh@yandex.ru', 'Блиц')->subject("Заказ с формы сайта");

            //Здесь указан дополнительный email адрес для отправки на почту сообщения
            $m->cc('info@burenie57.com', '');
            $m->cc('miron258@yandex.ru', '');
        });
    }

}
