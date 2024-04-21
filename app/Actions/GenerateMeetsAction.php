<?php

namespace App\Actions;

use App\Models\Meet;
use App\Models\User;

class GenerateMeetsAction
{
    public function __invoke() 
    {
        Meet::query()->update(['is_archive' => true]);
        // Получаем всех готовых пользователей и перемешиваем их
        $users = User::where('is_ready', true)
            ->where('is_confirmed', true)
            ->pluck('id')->all();

        shuffle($users);
    
        // Инициализируем индекс текущего пользователя
        $currentIndex = 0;
    
        // Считаем общее количество готовых пользователей
        $userCount = count($users);
            
        // Запускаем цикл для обработки всех готовых пользователей
        while ($userCount > 0) {
    
            // Получаем текущего пользователя и следующего пользователя для встречи. Если следующего пользователя нет (нечетное количество), то он равен null
            $user1 = $users[$currentIndex];
            $user2 = ($userCount > 1) ? $users[($currentIndex + 1) % $userCount] : null;
            
            // Если следующий пользователь есть и встреч между этими двумя пользователями еще не было, то можно создать встречу
            if($user2 && Meet::where('user1_id', $user1)->where('user2_id', $user2)->doesntExist() &&
               Meet::where('user1_id', $user2)->where('user2_id', $user1)->doesntExist()) {
                
                // Создаем встречу между текущим и следующим пользователем
                Meet::create([
                    'user1_id' => $user1,
                    'user2_id' => $user2
                ]);
    
                // Устанавливаем статус is_ready в false у двух пользователей, которые только что встретились
                User::where('id', $user1)->orWhere('id', $user2)->update(['is_ready' => true]);
            
            // Если следующего пользователя нет (нечетное число пользователей), то просто устанавливаем is_ready в false у последнего пользователя
            } else if ($user2 === null) {
                User::where('id', $user1)->update(['is_ready' => true]);
            
            // Если следующий пользователь есть, но встречи с текущим пользователе уже были, то просто переходим к следующей паре пользователей
            } else {
                $currentIndex++;
            }
    
            // Обновляем список готовых пользователей, т.к. мы только что изменили их статус is_ready
            $users = User::where('is_ready', true)->pluck('id')->all();
            $userCount = count($users);
    
            // Перемешиваем список готовых пользователей, чтобы каждая следующая встреча была с разными людьми
            shuffle($users);
    
            // Если мы дошли до конца списка, то начинаем с первого пользователя, что будет работать корректно, т.к. мы только что перемешали список
            if ($currentIndex >= $userCount) {
                shuffle($users);
                $currentIndex = 0;
            }
        }
    }
}