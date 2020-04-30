<?php

namespace Vitalii\Exam\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Psr\Log\LoggerInterface;
use Vitalii\Exam\Api\FruitRepositoryInterface;
use Vitalii\Exam\Api\Data\FruitInterface;
use Vitalii\Exam\Api\Data\FruitInterfaceFactory;

/**
 * Class CreateFruitsData
 */
class CreateFruitsData implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var FruitInterfaceFactory
     */
    private $fruitFactory;

    /**
     * @var FruitRepositoryInterface
     */
    private $fruitRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param FruitInterfaceFactory $fruitFactory
     * @param FruitRepositoryInterface $fruitRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        FruitInterfaceFactory $fruitFactory,
        FruitRepositoryInterface $fruitRepository,
        LoggerInterface $logger
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->fruitFactory = $fruitFactory;
        $this->fruitRepository = $fruitRepository;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        try {
            $data = [
                [
                    'entity_id' => null,
                    'fruit_name' => 'apple',
                    'color_id' => 'red',
                    'description' => 'An apple is a sweet, edible fruit produced by an apple tree (Malus domestica)',
                    'weight' => 3,
                    'taste' => 'sweet',
                    'price' => 9.99,
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'fruit_name' => 'banana',
                    'color_id' => 'yellow',
                    'description' => 'A banana is an edible fruit – botanically a berry – produced by several kinds of large herbaceous flowering plants in the genus Musa',
                    'weight' => 5,
                    'taste' => 'sweet',
                    'price' => 7.99,
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'fruit_name' => 'grape',
                    'color_id' => 'blue',
                    'description' => 'A grape is a fruit, botanically a berry, of the deciduous woody vines of the flowering plant genus Vitis',
                    'weight' => 8,
                    'taste' => 'sweet',
                    'price' => 6.99,
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'fruit_name' => 'lemon',
                    'color_id' => 'yellow',
                    'description' => 'The lemon, Citrus limon Osbeck, is a species of small evergreen tree in the flowering plant family Rutaceae, native to South Asia, primarily North eastern India',
                    'weight' => 7,
                    'taste' => 'bitter',
                    'price' => 1.99,
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'fruit_name' => 'orange',
                    'color_id' => 'orange',
                    'description' => 'The orange is the fruit of the citrus species Citrus sinensis in the family Rutaceae, native to China',
                    'weight' => 9,
                    'taste' => 'sweet',
                    'price' => 3.99,
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'fruit_name' => 'strawberry',
                    'color_id' => 'rose',
                    'description' => 'The garden strawberry (or simply strawberry; Fragaria ananassa) is a widely grown hybrid species of the genus Fragaria, collectively known as the strawberries, which are cultivated worldwide for their fruit',
                    'weight' => 1,
                    'taste' => 'sweet',
                    'price' => 5.99,
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'fruit_name' => 'apricot',
                    'color_id' => 'orange',
                    'description' => 'An apricot is a fruit, or the tree that bears the fruit, of several species in the genus Prunus (stone fruits)',
                    'weight' => 3,
                    'taste' => 'bitter',
                    'price' => 8.99,
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'fruit_name' => 'avocado',
                    'color_id' => 'green',
                    'description' => 'The avocado (Persea americana), a tree likely originating from south-central Mexico, is classified as a member of the flowering plant family Lauraceae',
                    'weight' => 5,
                    'taste' => 'bitter',
                    'price' => 7.99,
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'fruit_name' => 'blackberrie',
                    'color_id' => 'black',
                    'description' => 'The blackberry is an edible fruit produced by many species in the genus Rubus in the family Rosaceae, hybrids among these species within the subgenus Rubus, and hybrids between the subgenera Rubus and Idaeobatus',
                    'weight' => 2,
                    'taste' => 'sweet',
                    'price' => 4.99,
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'fruit_name' => 'clementine',
                    'color_id' => 'orange',
                    'description' => 'A clementine (Citrus clementina) is a tangor, a citrus fruit hybrid between a willowleaf mandarin orange (C. deliciosa) and a sweet orange (C. sinensis), named for its late 19th-century discoverer',
                    'weight' => 4,
                    'taste' => 'sweet',
                    'price' => 3.99,
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'fruit_name' => 'carambola',
                    'color_id' => 'yellow',
                    'description' => 'Carambola, or star fruit, or Birambi is the fruit of Averrhoa carambola, a species of tree native to tropical Southeast Asia',
                    'weight' => 8,
                    'taste' => 'bitter',
                    'price' => 5.99,
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'fruit_name' => 'cherry',
                    'color_id' => 'red',
                    'description' => 'A cherry is the fruit of many plants of the genus Prunus, and is a fleshy drupe (stone fruit)',
                    'weight' => 6,
                    'taste' => 'sweet',
                    'price' => 9.99,
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'fruit_name' => 'kiwifruit',
                    'color_id' => 'brown',
                    'description' => 'Kiwifruit (often shortened to kiwi outside Australia and New Zealand), or Chinese gooseberry, is the edible berry of several species of woody vines in the genus Actinidia',
                    'weight' => 5,
                    'taste' => 'bitter',
                    'price' => 2.99,
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'fruit_name' => 'mulberrie',
                    'color_id' => 'black',
                    'description' => 'Morus, a genus of flowering plants in the family Moraceae, consists of diverse species of deciduous trees commonly known as mulberries, growing wild and under cultivation in many temperate world regions',
                    'weight' => 1,
                    'taste' => 'sweet',
                    'price' => 2.99,
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'fruit_name' => 'pear',
                    'color_id' => 'green',
                    'description' => 'The pear tree and shrub are a species of genus Pyrus, in the family Rosaceae, bearing the pomaceous fruit of the same name',
                    'weight' => 9,
                    'taste' => 'sweet',
                    'price' => 8.99,
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'fruit_name' => 'pineapple',
                    'color_id' => 'brown',
                    'description' => 'The pineapple (Ananas comosus) is a tropical plant with an edible fruit, also called a pineapple, and the most economically significant plant in the family Bromeliaceae',
                    'weight' => 7,
                    'taste' => 'sweet',
                    'price' => 4.99,
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'fruit_name' => 'plum',
                    'color_id' => 'blue',
                    'description' => 'A plum is a fruit of the subgenus Prunus of the genus Prunus',
                    'weight' => 1,
                    'taste' => 'sweet',
                    'price' => 6.99,
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'fruit_name' => 'raspberry',
                    'color_id' => 'red',
                    'description' => 'The raspberry is the edible fruit of a multitude of plant species in the genus Rubus of the rose family, most of which are in the subgenus Idaeobatus; the name also applies to these plants themselves',
                    'weight' => 3,
                    'taste' => 'sweet',
                    'price' => 1.99,
                    'created_at' => '',
                ]
            ];
            foreach ($data as $row) {
                /** @var FruitInterface $newFruit */
                $newFruit = $this->fruitFactory->create();
                $newFruit->setFruitName($row['fruit_name']);
                $newFruit->setColorId($row['color_id']);
                $newFruit->setDescription($row['description']);
                $newFruit->setWeight($row['weight']);
                $newFruit->setTaste($row['taste']);
                $newFruit->setPrice($row['price']);
                $newFruit->setCreatedAt('now');
                $this->fruitRepository->save($newFruit);
            }
        } catch (\Exception $exception) {
            $this->logger->debug('Cannot save new fruit model, message: "'. $exception->getMessage() . '"');
        }

        $this->moduleDataSetup->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [
            CreateColorsData::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
