<?php

namespace Vitalii\Exam\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Vitalii\Exam\Api\ColorRepositoryInterface;
use Vitalii\Exam\Api\Data\ColorInterface;
use Vitalii\Exam\Api\Data\ColorInterfaceFactory;
use Psr\Log\LoggerInterface;

/**
 * Class CreateColorsData
 */
class CreateColorsData implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var ColorInterfaceFactory
     */
    private $colorFactory;

    /**
     * @var ColorRepositoryInterface
     */
    private $colorRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param ColorInterfaceFactory $colorFactory
     * @param ColorRepositoryInterface $colorRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        ColorInterfaceFactory $colorFactory,
        ColorRepositoryInterface $colorRepository,
        LoggerInterface $logger
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->colorFactory = $colorFactory;
        $this->colorRepository = $colorRepository;
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
                    'color_name' => 'yellow',
                    'description' => 'Yellow is the color between orange and green on the spectrum of visible light',
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'color_name' => 'green',
                    'description' => 'Green is the color between blue and yellow on the visible spectrum',
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'color_name' => 'blue',
                    'description' => 'Blue is one of the three primary colors of pigments in painting and traditional color theory, as well as in the RGB color model',
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'color_name' => 'red',
                    'description' => 'Red is the color at the end of the visible spectrum of light, next to orange and opposite violet',
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'color_name' => 'orange',
                    'description' => 'Orange is the color between yellow and red on the spectrum of visible light',
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'color_name' => 'rose',
                    'description' => 'Rose is the color halfway between red and magenta on the HSV color wheel, also known as the RGB color wheel, on which it is at hue angle of 330 degrees',
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'color_name' => 'brown',
                    'description' => 'Brown is a composite color. In the CMYK color model used in printing or painting, brown is made by combining red, black, and yellow, or red, yellow, and blue',
                    'created_at' => '',
                ],
                [
                    'entity_id' => null,
                    'color_name' => 'black',
                    'description' => 'Black is the darkest color, the result of the absence or complete absorption of visible light',
                    'created_at' => '',
                ]
            ];
            foreach ($data as $row) {
                /** @var ColorInterface $newColor */
                $newColor = $this->colorFactory->create();
                $newColor->setColorName($row['color_name']);
                $newColor->setDescription($row['description']);
                $newColor->setCreatedAt('now');
                $this->colorRepository->save($newColor);
            }
        } catch (\Exception $exception) {
            $this->logger->debug('Cannot save new color model, message: "'. $exception->getMessage() . '"');
        }

        $this->moduleDataSetup->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
