<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'id' => 1,
                'title' => 'Smart Phones',
                'slug' => 'smart-phones',
                'desc' => 'Смартфон – универсальное устройство, предназначенное для общения, работы и развлечений. В отличие от обычного кнопочного телефона, у него есть сенсорный экран, открывающий широкие возможности для веб-серфинга, игр, просмотра фильмов. Как выбрать смартфон? Каталог смартфонов чрезвычайно широк, и разобраться в этом многообразии нелегко. Первое, с чего стоит начать, – операционная система.',
                'img' => 'categories/categories.jpg',
            ],
            [
                'id' => 2,
                'title' => 'Headphones',
                'slug' => 'headphones',
                'desc' => 'Наушники обычно используются для прослушивания музыки. Они подключаются к смартфонам, планшетам, аудиоплеерам и другим устройствам с помощью кабеля со стандартным 3,5-миллиметровым коннектором либо посредством Bluetooth. Также полноразмерные и внутриканальные наушники применяются, чтобы смотреть фильмы и играть в игры, не отвлекая окружающих. Отдельная категория наушников – гарнитуры. Они дополнены микрофоном и системой управления, позволяющей легко переключаться с прослушивания музыки на телефонный разговор и обратно.',
                'img' => 'categories/avds_xl.jpg',
            ],
            [
                'id' => 3,
                'title' => 'Cameras',
                'slug' => 'cameras',
                'desc' => 'Снимать фотографии и видеоролики можно и с помощью смартфонов, но фотоаппарат предоставляет владельцу больше возможностей. К тому же он зачастую обеспечивает более высокое качество снимка, особенно если пользоваться зеркальным фотоаппаратом. Цифровые фото можно просматривать и хранить на разных устройствах, а также обрабатывать в графических редакторах. Основные типы фотоаппаратов В продаже сегодня представлено множество моделей, различающихся по конструкции и набору функций.',
                'img' => 'categories/avds_large.jpg',
            ],
            [
                'id' => 4,
                'title' => 'Tablets',
                'slug' => 'tablets',
                'desc' => 'Планшет или планшетный компьютер взял на себя задачи по образованию и обучению, прекрасно помогает узнавать новое и заодно носить с собой массу данных. Размеры планшета определяют сценарий использования. Недорогие, но хорошие модели, где диагональ экрана составляет около 7-8 дюймов, принято называть мобильными, тогда как за более крупными 10-13-дюймовыми решениями закрепилась слава домашних или рабочих устройств. Универсальная покупка – устройство на iOS. Модели от Apple легко освоит даже совсем юный пользователь, они удобные и надёжные, прослужат долго. Мощный Apple iPad Pro, к примеру, легко возьмёт на себя функции видеомонтажа, с его помощью можно прямо на ходу сделать видеоролик и с комфортом посмотреть на экране 9.7 или 12.9 дюймов. Также он способен служить игровым планшетом. Важно знать, что на девайсы устанавливаются разные ОС.',
                'img' => 'categories/categories.jpg',
            ],
        ]);
    }
}
