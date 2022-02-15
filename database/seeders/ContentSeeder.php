<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $properties = [
            [
                'name' => 'Цвет',
                'name_en' => 'Color',
                'options' => [
                    [
                        'name' => 'Белый',
                        'name_en' => 'White',
                    ],
                    [
                        'name' => 'Черный',
                        'name_en' => 'Black',
                    ],
                    [
                        'name' => 'Серебристый',
                        'name_en' => 'Silver',
                    ],
                    [
                        'name' => 'Золотой',
                        'name_en' => 'Gold',
                    ],
                    [
                        'name' => 'Красный',
                        'name_en' => 'Red',
                    ],
                    [
                        'name' => 'Синий',
                        'name_en' => 'Blue',
                    ],
                ],
            ],
            [
                'name' => 'Внутренняя память',
                'name_en' => 'Memory',
                'options' => [
                    [
                        'name' => '32гб',
                        'name_en' => '32gb',
                    ],
                    [
                        'name' => '64гб',
                        'name_en' => '64gb',
                    ],
                    [
                        'name' => '128гб',
                        'name_en' => '128gb',
                    ],
                    [
                        'name' => '256гб',
                        'name_en' => '256gb',
                    ],
                ],
            ],
        ];

        foreach ($properties as $property) {
            $property['created_at'] = Carbon::now();
            $property['updated_at'] = Carbon::now();
            $options = $property['options'];
            unset($property['options']);
            $propertyId = DB::table('properties')->insertGetId($property);

            foreach ($options as $option) {
                $option['created_at'] = Carbon::now();
                $option['updated_at'] = Carbon::now();
                $option['property_id'] = $propertyId;
                DB::table('property_options')->insert($option);
            }
        }

        $categories = [
            [
                'title' => 'Смартфоны',
                'title_en' => 'Smart Phones',
                'slug' => 'smart-phones',
                'desc' => 'Смартфон – универсальное устройство, предназначенное для общения, работы и развлечений. В отличие от обычного кнопочного телефона, у него есть сенсорный экран, открывающий широкие возможности для веб-серфинга, игр, просмотра фильмов. Как выбрать смартфон? Каталог смартфонов чрезвычайно широк, и разобраться в этом многообразии нелегко. Первое, с чего стоит начать, – операционная система.',
                'desc_en' => 'A smartphone is a versatile device designed for communication, work and entertainment. Unlike a conventional push-button telephone, it has a touch screen that opens up wide possibilities for surfing the web, playing games, watching movies. How to choose a smartphone? The catalog of smartphones is extremely wide, and it is not easy to understand this variety. The first place to start is the operating system.',
                'img' => 'categories/mobile.jpg',
                'products' => [
                    [
                        'title' => 'Смартфон XIAOMI Redmi 9',
                        'title_en' => 'XIAOMI Redmi 9 Smartphone',
                        'description' => 'Всегда оставаться на связи поможет смартфон XIAOMI Redmi 9 32Gb. Данная модель укомплектована аккумуляторной батареей, заряда которой хватит на несколько дней продуктивного использования. Кроме того, устройство работает за счет процессора Mediatek Helio G80 с частотой 2000 МГц, что обеспечивает хорошую производительность. При этом сохранить достаточное количество данных, загружать видео или приложения получится благодаря оперативной памяти на 3 Гб Основным преимуществом смартфона XIAOMI Redmi 9 32Gb является возможность установки сразу 2 SIM-карт для активного общения с друзьями или же коллегами по работе. Наличие основной камеры на 13 Мп и фронтальной на 5 Мп предусматривает создание качественных фотографий, а выход в интернет возможен через 3G, 4G или Wi-Fi. Модель имеет дисплей диагональю 6,53 дюйма с разрешением 2340x1080 пикселей для воспроизведения четкой картинки.',
                        'description_en' => 'The XIAOMI Redmi 9 32Gb smartphone will always help you stay in touch. This model is equipped with a rechargeable battery, the charge of which is enough for several days of productive use. In addition, the device is powered by a Mediatek Helio G80 processor with a frequency of 2000 MHz, which provides good performance. At the same time, you can save enough data, download videos or applications thanks to 3 GB of RAM. The main advantage of the XIAOMI Redmi 9 32Gb smartphone is the ability to install 2 SIM cards at once for active communication with friends or work colleagues. The presence of a main camera of 13 MP and a front camera of 5 MP provides for the creation of high-quality photos, and Internet access is possible via 3G, 4G or Wi-Fi. The model has a display with a diagonal of 6.53 inches with a resolution of 2340x1080 pixels for a clear picture.',
                        'properties' => [
                            1, 2,
                        ],
                        'options' => [
                            [
                                1, 7,
                            ],
                            [
                                1, 8,
                            ],
                            [
                                1, 9,
                            ],
                            [
                                3, 8,
                            ],
                            [
                                3, 9,
                            ],
                            [
                                6, 7,
                            ],
                            [
                                6, 8,
                            ],
                        ],
                    ],
                ],
            ],
            [
                'title' => 'Наушники',
                'title_en' => 'Headphones',
                'slug' => 'headphones',
                'desc' => 'Наушники обычно используются для прослушивания музыки. Они подключаются к смартфонам, планшетам, аудиоплеерам и другим устройствам с помощью кабеля со стандартным 3,5-миллиметровым коннектором либо посредством Bluetooth. Также полноразмерные и внутриканальные наушники применяются, чтобы смотреть фильмы и играть в игры, не отвлекая окружающих. Отдельная категория наушников – гарнитуры. Они дополнены микрофоном и системой управления, позволяющей легко переключаться с прослушивания музыки на телефонный разговор и обратно.',
                'desc_en' => 'Headphones are commonly used for listening to music. They connect to smartphones, tablets, audio players and other devices using a cable with a standard 3.5 mm connector or via Bluetooth. Also, full-size and in-ear headphones are used to watch movies and play games without distracting others. A separate category of headphones is headsets. They are complemented by a microphone and a control system that allows you to easily switch from listening to music to a telephone conversation and vice versa.',
                'img' => 'categories/avds_xl.jpg',
                'products' => [
                    [
                        'title' => 'Наушники Koss Pro4S',
                        'title_en' => 'Headphones Koss Pro4S',
                        'description' => 'Имеют уникальные чашки D-формы и удобные амбушюры, что обеспечивает комфорт при длительном использовании. Модель обладает улучшенной звукоизоляцией и снабжена 40-миллиметровыми драйверами SLX40.',
                        'description_en' => 'They feature unique D-shaped cups and comfortable ear cushions for long-term comfort. The model has improved sound insulation and is equipped with 40 mm SLX40 drivers.',
                        'properties' => [
                            1,
                        ],
                        'options' => [
                            [
                                1,
                            ],
                            [
                                2,
                            ],
                            [
                                3,
                            ]
                        ],
                    ],
                ],
            ],
            [
                'title' => 'Фотоаппараты',
                'title_en' => 'Cameras',
                'slug' => 'cameras',
                'desc' => 'Снимать фотографии и видеоролики можно и с помощью смартфонов, но фотоаппарат предоставляет владельцу больше возможностей. К тому же он зачастую обеспечивает более высокое качество снимка, особенно если пользоваться зеркальным фотоаппаратом. Цифровые фото можно просматривать и хранить на разных устройствах, а также обрабатывать в графических редакторах. Основные типы фотоаппаратов В продаже сегодня представлено множество моделей, различающихся по конструкции и набору функций.',
                'desc_en' => 'You can take photos and videos using smartphones, but the camera provides the owner with more options. In addition, it often provides better image quality, especially when using a DSLR. Digital photos can be viewed and stored on different devices, as well as processed in graphic editors. The main types of cameras On sale today there are many models that differ in design and set of functions.',
                'img' => 'categories/avds_large.jpg',
                'products' => [
                    [
                        'title' => 'Фотоаппарат зеркальный Canon EOS 2000D EF-S 18-55 III Kit',
                        'title_en' => 'Canon EOS 2000D EF-S 18-55 III Kit',
                        'description' => 'Зеркальный фотоаппарат Canon EOS 2000D EF-S 18-55 III Kit — оптимальный выбор для новичков, которые только начинают свой путь к профессиональной съемке. Его простой интерфейс предоставляет быстрый доступ ко всем функциям, настройкам и художественным фильтрам. Большой дисплей позволяет сразу просматривать полученные кадры и вносить корректировки при необходимости. Цифровой фотоаппарат Canon EOS 2000D снабжен современной CMOS-матрицей и мощным процессором. Совместная работа этих компонентов помогает получать очень четкие снимки с минимальным уровнем шумов и яркими насыщенными цветами. Вы также можете запечатлеть динамику, записывая Full HD-видео и создавая серии полноразмерных фотографий.',
                        'description_en' => 'The Canon EOS 2000D EF-S 18-55 III Kit SLR camera is the best choice for beginners who are just starting their way to professional photography. Its simple interface provides quick access to all features, settings and artistic filters. The large display allows you to immediately view the received frames and make adjustments if necessary. The Canon EOS 2000D digital camera is equipped with a modern CMOS-matrix and a powerful processor. These components work together to produce very clear images with minimal noise and bright, saturated colors. You can also capture the momentum by recording Full HD videos and taking bursts of full size photos.',
                        'properties' => [
                            1,
                        ],
                        'options' => [
                            [
                                2,
                            ]
                        ]
                    ],
                ],
            ],
            [
                'title' => 'Планшеты',
                'title_en' => 'Tablets',
                'slug' => 'tablets',
                'desc' => 'Планшет или планшетный компьютер взял на себя задачи по образованию и обучению, прекрасно помогает узнавать новое и заодно носить с собой массу данных. Размеры планшета определяют сценарий использования. Недорогие, но хорошие модели, где диагональ экрана составляет около 7-8 дюймов, принято называть мобильными, тогда как за более крупными 10-13-дюймовыми решениями закрепилась слава домашних или рабочих устройств. Универсальная покупка – устройство на iOS. Модели от Apple легко освоит даже совсем юный пользователь, они удобные и надёжные, прослужат долго. Мощный Apple iPad Pro, к примеру, легко возьмёт на себя функции видеомонтажа, с его помощью можно прямо на ходу сделать видеоролик и с комфортом посмотреть на экране 9.7 или 12.9 дюймов. Также он способен служить игровым планшетом. Важно знать, что на девайсы устанавливаются разные ОС.',
                'desc_en' => 'A tablet or tablet computer has taken over the tasks of education and training, it perfectly helps to learn new things and at the same time carry a lot of data with you. The dimensions of the tablet dictate the use case. Inexpensive, but good models, where the screen diagonal is about 7-8 inches, are usually called mobile, while the glory of home or work devices is fixed for larger 10-13-inch solutions. One-stop shopping - iOS device. Apple\'s models can be easily mastered by even a very young user, they are comfortable and reliable, and will last a long time. The powerful Apple iPad Pro, for example, can easily take over the functions of video editing, with its help you can make a video on the go and watch it comfortably on a 9.7 or 12.9-inch screen. It is also capable of serving as a gaming tablet. It is important to know that different operating systems are installed on the devices.',
                'img' => 'categories/categories.jpg',
                'products' => [
                    [
                        'title' => 'Планшет Apple 12.9\'\' iPad Pro Wi-Fi+Cell',
                        'title_en' => 'Apple 12.9\'\' iPad Pro Wi-Fi+Cell',
                        'description' => 'Планшет или планшетный компьютер взял на себя задачи по образованию и обучению, прекрасно помогает узнавать новое и заодно носить с собой массу данных. Размеры планшета определяют сценарий использования. Недорогие, но хорошие модели, где диагональ экрана составляет около 7-8 дюймов, принято называть мобильными, тогда как за более крупными 10-13-дюймовыми решениями закрепилась слава домашних или рабочих устройств. Универсальная покупка – устройство на iOS. Модели от Apple легко освоит даже совсем юный пользователь, они удобные и надёжные, прослужат долго. Мощный Apple iPad Pro, к примеру, легко возьмёт на себя функции видеомонтажа, с его помощью можно прямо на ходу сделать видеоролик и с комфортом посмотреть на экране 9.7 или 12.9 дюймов. Также он способен служить игровым планшетом. Важно знать, что на девайсы устанавливаются разные ОС.',
                        'description_en' => 'A tablet or tablet computer has taken over the tasks of education and training, it perfectly helps to learn new things and at the same time carry a lot of data with you. The dimensions of the tablet dictate the use case. Inexpensive, but good models, where the screen diagonal is about 7-8 inches, are usually called mobile, while the glory of home or work devices is fixed for larger 10-13-inch solutions. One-stop shopping - iOS device. Apple\'s models can be easily mastered by even a very young user, they are comfortable and reliable, and will last a long time. The powerful Apple iPad Pro, for example, can easily take over the functions of video editing, with its help you can make a video on the go and watch it comfortably on a 9.7 or 12.9-inch screen. It is also capable of serving as a gaming tablet. It is important to know that different operating systems are installed on the devices.',
                        'properties' => [
                            1, 2,
                        ],
                        'options' => [
                            [
                                1, 10,
                            ],
                            [
                                3, 10,
                            ],
                        ]
                    ],
                ],
            ]
        ];

        foreach ($categories as $category) {
            $category['created_at'] = Carbon::now();
            $category['updated_at'] = Carbon::now();
            $products = $category['products'];
            unset($category['products']);
            $categoryId = DB::table('categories')->insertGetId($category);

            foreach ($products as $product) {
                $product['created_at'] = Carbon::now();
                $product['updated_at'] = Carbon::now();
                $product['hit'] = !boolval(rand(0, 3));
                $product['recommend'] = rand(0, 1);
                $product['new'] = rand(0, 1);
                $product['category_id'] = $categoryId;

                if (isset($product['properties'])) {
                    $properties = $product['properties'];
                    unset($product['properties']);
                    $skusOptions = $product['options'];
                    unset($product['options']);
                }

                $productId = DB::table('products')->insertGetId($product);

                if (isset($properties)) {
                    foreach ($properties as $propertyId) {
                        DB::table('property_product')->insert([
                            'product_id' => $productId,
                            'property_id' => $propertyId,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }

                    foreach ($skusOptions as $skuOptions) {
                        $skuId = DB::table('skus')->insertGetId([
                            'product_id' => $productId,
                            'count' => rand(1, 50),
                            'price' => rand(5000, 100000),
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);

                        foreach ($skuOptions as $skuOption) {
                            $skuData['sku_id'] = $skuId;
                            $skuData['property_option_id'] = $skuOption;
                            $skuData['created_at'] = Carbon::now();
                            $skuData['updated_at'] = Carbon::now();

                            DB::table('sku_property_option')->insert($skuData);
                        }
                    }

                    unset($properties);
                } else {
                    DB::table('skus')->insert([
                        'product_id' => $productId,
                        'count' => rand(1, 50),
                        'price' => rand(5000, 100000),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
            }
        }
    }
}
