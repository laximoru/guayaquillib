# Guayaquil v3.0

* Описание API можно прочитать на [wiki.technologytrade.ru](http://wiki.technologytrade.ru)*

**Требования:**

* PHP 7.1+
* php-soap
* php-xml

### Установка

    composer require laximoru/guayaquillib

### Использование

SDK поддерживает 2 варианта вызовов методов API:

* По одной команде
* Пачкой до 5 команд

Второй вариант позволяет экономить время при одновременном получении данных от нескольких функций

## Laximo.OEM

**Пример получение списка каталогов**

    $oem = new ServiceOem('your login', 'your password');
    print_r($oem->listCatalogs());
    print_r($oem->getCatalogInfo('CFIAT84'));

Для отправки 1 запроса на сервер

    $oem = new ServiceOem('your login', 'your password');
    $oem->queryButch([
        Oem::listCatalogs(),
        Oem::getCatalogInfo('CFIAT84'),
    ]);

**Примеры поиска автомобилей**

    $oem = new ServiceOem('your login', 'your password');
    print_r($oem->findVehicle('XZU423-0001026'));
    print_r($oem->findVehicleByVin('WAUZZZ4M6JD010702'));
    print_r($oem->findVehicleByFrameNo('XZU423-0001026'));
    print_r($oem->execCustomOperation('DAF', 'findByChassisNumber', ['chassis' => 'EB100567']));
    print_r($oem->getVehicleInfo('TOYOTA00', '$*KwFEcGEOQQ9FN0UYBAtiQhwIKC8xR0RDQFFXVBI3C1MfA1JIDWdvNzo1U1pVGQENGx8uLSVFRERAQh8QDURBUl1UFBNQFQMKQUZBQkZVXFBCQh9MVSgrI0NCQQJ1bDA6J1NaVRYbSwMHREBIDAAAAACTKWcw$', '0'));

**Wizard**

    $oem = new ServiceOem('your login', 'your password');
    print_r($oem->getWizard2('TOYOTA00'));
    print_r($oem->findVehicleByWizard2('TOYOTA00', '$*KwFjOT5aYAAAAACPdHQr$'));

**Группы быстрого поиска**

    $oem = new ServiceOem('your login', 'your password');
    print_r($oem->listQuickGroup('TOYOTA00', '0', '$*KwGOuquo3tjYivXOyIC1stbC4uX7jY6Jipudntj9wZnf3piCxcnGjYyIioyflpjHgoOeh5qZ7Pzo-ajJ25yf19ieh5qarrvEjJCYl5yfzNvH0dfSyNbXkJ2Y3oyP1Yadi8YAAAAApF2TDg==$'));
    print_r($oem->listQuickDetail('TOYOTA00', '0', '$*KwGOuquo3tjYivXOyIC1stbC4uX7jY6Jipudntj9wZnf3piCxcnGjYyIioyflpjHgoOeh5qZ7Pzo-ajJ25yf19ieh5qarrvEjJCYl5yfzNvH0dfSyNbXkJ2Y3oyP1Yadi8YAAAAApF2TDg==$', 2));

**Категории**

    $oem = new ServiceOem('your login', 'your password');
    print_r($oem->listCategories('TOYOTA00', '0', '$*KwGOuquo3tjYivXOyIC1stbC4uX7jY6Jipudntj9wZnf3piCxcnGjYyIioyflpjHgoOeh5qZ7Pzo-ajJ25yf19ieh5qarrvEjJCYl5yfzNvH0dfSyNbXkJ2Y3oyP1Yadi8YAAAAApF2TDg==$'));
    print_r($oem->listUnits('TOYOTA00', '0', '$*KwEsGAkKfHp6KFdsaiIXEHRgQEdZLywrKDknFWU9bDskPUI4a2s2PCUpZGBpcX4HMnd9fDojPj0pK3Z7ZC49NDk8dmw4fWl3Tl5KWFM9NDplJDY8JTg7VU8rKmpreT49bno8JTh0MiU5Mj86f3d7OiBneCgAAAAA9q8C0Q==$', 1));
    print_r($oem->getUnitInfo('TOYOTA00', '$*KwH3w9LRp6Gh84y3sfnMy6-7m5yC9Pfw8-L8zr7mt-D_5pnjsLDt5_7yv7uxqqXc6aymrafg__Xv4_r76uf-4fPy9PLjsLDnq-b54IiF8_WooMjnub20rKCDur7x7ef-4-D09fLzraKs6eThq7Hm-eG-ws-XhY7g6eThrP-wtOXmiJL29O7jsLKss6fh-OWqtq3wvq7noqqm5_7j8OEAAAAAdQF_qg==$', 3423));

## Laximo.Aftermarket

**Поиск деталей по артикулу**

    $am = new ServiceAm('your login', 'your password');
    print_r($am->findOem('c110'));
    print_r($am->findOem('c110', 'vic'));
    print_r($am->findOem('c110', 'vic', [Am::optionsCrosses]));
    print_r($am->findOem('90471-PX4-000', 'HONDA', [Am::optionsCrosses]));
    print_r($am->findOem('AN723K', 'AKEBONO', [Am::optionsImages]));
    print_r($am->findOem('44010-S04-961', 'honda', [Am::optionsCrosses], [Am::replacementTypePartOfTheWhole]));

**Поиск деталей по id**

    print_r($am->findPart(2175522, [Am::optionsCrosses]));

**Производители запчастей**

    print_r($am->listManufacturer());
    print_r($am->getManufacturerInfo(6166));

**Исправление ошибок в артикуле**

    print_r($am->findOemCorrection('10471PX4000'));
