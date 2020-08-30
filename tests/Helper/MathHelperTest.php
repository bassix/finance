<?php
declare(strict_types=1);

namespace SUPR\BaseBundle\Tests\Helper;

use Bassix\Finance\Helper\MathHelper;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Bassix\Finance\Helper\MathHelper
 */
class MathHelperTest extends TestCase
{
    public function testToInt(): void
    {
        foreach ($this->getCasesForToInt() as $row => $toInt) {
            self::assertEquals(
                $toInt['expected'],
                MathHelper::toInt($toInt['actual']['number'], $toInt['actual']['absolute']),
                sprintf(
                    'The Test at row "%s" expects "%s" if "%s" with absolute "%s" is given!',
                    $row,
                    $toInt['expected'],
                    $toInt['actual']['number'],
                    true === $toInt['actual']['absolute'] ? 'true' : 'false'
                )
            );
        }
    }

    public function testBcCeil(): void
    {
        self::assertEquals(MathHelper::bcCeil('4'), ceil('4'));
        self::assertEquals(MathHelper::bcCeil('4.3'), ceil('4.3'));
        self::assertEquals(MathHelper::bcCeil('9.999'), ceil('9.999'));
        self::assertEquals(MathHelper::bcCeil('-3.14'), ceil('-3.14'));
    }

    public function testBcFloor(): void
    {
        self::assertEquals(MathHelper::bcFloor('4'), floor('4'));
        self::assertEquals(MathHelper::bcFloor('4.3'), floor('4.3'));
        self::assertEquals(MathHelper::bcFloor('9.999'), floor('9.999'));
        self::assertEquals(MathHelper::bcFloor('-3.14'), floor('-3.14'));
    }

    public function testBcRound(): void
    {
        foreach ($this->getCasesForBcRoundRaggedEdge() as $row => $raggedEdge) {
            self::assertEquals(
                $raggedEdge['expected'],
                MathHelper::bcRound($raggedEdge['actual']['number'], $raggedEdge['actual']['precision']),
                sprintf(
                    'The Test at row "%s" expects "%s" if "%s" with precision "%s" is given!',
                    $row,
                    $raggedEdge['expected'],
                    $raggedEdge['actual']['number'],
                    $raggedEdge['actual']['precision']
                )
            );
        }
    }

    public function testBcCompZero(): void
    {
        foreach ($this->getCasesForBcCompZero() as $row => $compZero) {
            self::assertEquals(
                $compZero['expected'],
                MathHelper::bcCompZero($compZero['actual']),
                sprintf(
                    'The Test at row "%s" expects "%s" if "%s" is given!',
                    $row,
                    $compZero['expected'],
                    $compZero['actual']
                )
            );
        }
    }

    public function testCanBeFloat(): void
    {
        foreach ($this->getCasesForCanBeFloat() as $row => $canBeFloat) {
            self::assertEquals(
                $canBeFloat['expected'],
                MathHelper::numberCanBeUsedAsFloat($canBeFloat['number']),
                sprintf(
                    'The Test at row "%s" expects "%s" if "%s" is given!',
                    $row,
                    ($canBeFloat['expected']) ? 'true' : 'false',
                    $canBeFloat['number']
                )
            );
        }
    }

    // -- PRIVATE ------------------------------------------------------------------------------------------------------

    /**
     * List of test cases with values to be converted to integer.
     *
     */
    private function getCasesForToInt(): array
    {
        return [
            0 => ['expected' => 1, 'actual' => ['number' => 1, 'absolute' => false]],
            1 => ['expected' => 1, 'actual' => ['number' => 1, 'absolute' => true]],
            2 => ['expected' => -1, 'actual' => ['number' => -1, 'absolute' => false]],
            3 => ['expected' => 1, 'actual' => ['number' => -1, 'absolute' => true]],
            4 => ['expected' => 1, 'actual' => ['number' => 0.9999, 'absolute' => false]],
            5 => ['expected' => 1, 'actual' => ['number' => 1.1111, 'absolute' => false]],
            6 => ['expected' => -1, 'actual' => ['number' => -0.9999, 'absolute' => false]],
            7 => ['expected' => -1, 'actual' => ['number' => -1.1111, 'absolute' => false]],
            8 => ['expected' => 1, 'actual' => ['number' => -0.9999, 'absolute' => true]],
            9 => ['expected' => 1, 'actual' => ['number' => -1.1111, 'absolute' => true]],
        ];
    }

    /**
     * List of test cases with rounding values as expected and an initial value.
     *
     */
    private function getCasesForBcRoundRaggedEdge(): array
    {
        return [
            0 => ['expected' => '0.99', 'actual' => ['number' => '0.9890', 'precision' => 2]],
            1 => ['expected' => '0.99', 'actual' => ['number' => '0.9891', 'precision' => 2]],
            2 => ['expected' => '0.99', 'actual' => ['number' => '0.9892', 'precision' => 2]],
            3 => ['expected' => '0.99', 'actual' => ['number' => '0.9893', 'precision' => 2]],
            4 => ['expected' => '0.99', 'actual' => ['number' => '0.9894', 'precision' => 2]],
            5 => ['expected' => '0.99', 'actual' => ['number' => '0.9895', 'precision' => 2]],
            6 => ['expected' => '0.99', 'actual' => ['number' => '0.9896', 'precision' => 2]],
            7 => ['expected' => '0.99', 'actual' => ['number' => '0.9897', 'precision' => 2]],
            8 => ['expected' => '0.99', 'actual' => ['number' => '0.9898', 'precision' => 2]],
            9 => ['expected' => '0.99', 'actual' => ['number' => '0.9899', 'precision' => 2]],
            10 => ['expected' => '0.99', 'actual' => ['number' => '0.9901', 'precision' => 2]],
            11 => ['expected' => '0.99', 'actual' => ['number' => '0.9902', 'precision' => 2]],
            12 => ['expected' => '0.99', 'actual' => ['number' => '0.9903', 'precision' => 2]],
            13 => ['expected' => '0.99', 'actual' => ['number' => '0.9904', 'precision' => 2]],
            14 => ['expected' => '0.99', 'actual' => ['number' => '0.9905', 'precision' => 2]],
            15 => ['expected' => '0.99', 'actual' => ['number' => '0.9906', 'precision' => 2]],
            16 => ['expected' => '0.99', 'actual' => ['number' => '0.9907', 'precision' => 2]],
            17 => ['expected' => '0.99', 'actual' => ['number' => '0.9908', 'precision' => 2]],
            18 => ['expected' => '0.99', 'actual' => ['number' => '0.9909', 'precision' => 2]],
            19 => ['expected' => '0.99', 'actual' => ['number' => '0.9910', 'precision' => 2]],
            20 => ['expected' => '0.99', 'actual' => ['number' => '0.9920', 'precision' => 2]],
            21 => ['expected' => '0.99', 'actual' => ['number' => '0.9930', 'precision' => 2]],
            22 => ['expected' => '0.99', 'actual' => ['number' => '0.9940', 'precision' => 2]],
            23 => ['expected' => '0.99', 'actual' => ['number' => '0.9941', 'precision' => 2]],
            24 => ['expected' => '0.99', 'actual' => ['number' => '0.9942', 'precision' => 2]],
            25 => ['expected' => '0.99', 'actual' => ['number' => '0.9943', 'precision' => 2]],
            26 => ['expected' => '0.99', 'actual' => ['number' => '0.9944', 'precision' => 2]],
            27 => ['expected' => '0.99', 'actual' => ['number' => '0.9945', 'precision' => 2]],
            28 => ['expected' => '0.99', 'actual' => ['number' => '0.9946', 'precision' => 2]],
            29 => ['expected' => '0.99', 'actual' => ['number' => '0.9947', 'precision' => 2]],
            30 => ['expected' => '0.99', 'actual' => ['number' => '0.9948', 'precision' => 2]],
            31 => ['expected' => '0.99', 'actual' => ['number' => '0.9949', 'precision' => 2]],
            32 => ['expected' => '1.00', 'actual' => ['number' => '0.9950', 'precision' => 2]],
            33 => ['expected' => '1.00', 'actual' => ['number' => '0.9951', 'precision' => 2]],
            34 => ['expected' => '1.00', 'actual' => ['number' => '0.9952', 'precision' => 2]],
            35 => ['expected' => '1.00', 'actual' => ['number' => '0.9953', 'precision' => 2]],
            36 => ['expected' => '1.00', 'actual' => ['number' => '0.9954', 'precision' => 2]],
            37 => ['expected' => '1.00', 'actual' => ['number' => '0.9955', 'precision' => 2]],
            38 => ['expected' => '1.00', 'actual' => ['number' => '0.9956', 'precision' => 2]],
            39 => ['expected' => '1.00', 'actual' => ['number' => '0.9957', 'precision' => 2]],
            40 => ['expected' => '1.00', 'actual' => ['number' => '0.9958', 'precision' => 2]],
            41 => ['expected' => '1.00', 'actual' => ['number' => '0.9959', 'precision' => 2]],
            42 => ['expected' => '1.00', 'actual' => ['number' => '0.9960', 'precision' => 2]],
            43 => ['expected' => '1.00', 'actual' => ['number' => '0.9970', 'precision' => 2]],
            44 => ['expected' => '1.00', 'actual' => ['number' => '0.9980', 'precision' => 2]],
            45 => ['expected' => '1.00', 'actual' => ['number' => '0.9990', 'precision' => 2]],
            46 => ['expected' => '1.00', 'actual' => ['number' => '0.9991', 'precision' => 2]],
            47 => ['expected' => '1.00', 'actual' => ['number' => '0.9992', 'precision' => 2]],
            48 => ['expected' => '1.00', 'actual' => ['number' => '0.9993', 'precision' => 2]],
            49 => ['expected' => '1.00', 'actual' => ['number' => '0.9994', 'precision' => 2]],
            50 => ['expected' => '1.00', 'actual' => ['number' => '0.9995', 'precision' => 2]],
            51 => ['expected' => '1.00', 'actual' => ['number' => '0.9996', 'precision' => 2]],
            52 => ['expected' => '1.00', 'actual' => ['number' => '0.9997', 'precision' => 2]],
            53 => ['expected' => '1.00', 'actual' => ['number' => '0.9998', 'precision' => 2]],
            54 => ['expected' => '1.00', 'actual' => ['number' => '0.9999', 'precision' => 2]],
            55 => ['expected' => '1.00', 'actual' => ['number' => '1.0000', 'precision' => 2]],
            56 => ['expected' => '1.00', 'actual' => ['number' => '1.0001', 'precision' => 2]],
            57 => ['expected' => '1.00', 'actual' => ['number' => '1.0002', 'precision' => 2]],
            58 => ['expected' => '1.00', 'actual' => ['number' => '1.0003', 'precision' => 2]],
            59 => ['expected' => '1.00', 'actual' => ['number' => '1.0004', 'precision' => 2]],
            60 => ['expected' => '1.00', 'actual' => ['number' => '1.0005', 'precision' => 2]],
            61 => ['expected' => '1.00', 'actual' => ['number' => '1.0006', 'precision' => 2]],
            62 => ['expected' => '1.00', 'actual' => ['number' => '1.0007', 'precision' => 2]],
            63 => ['expected' => '1.00', 'actual' => ['number' => '1.0008', 'precision' => 2]],
            64 => ['expected' => '1.00', 'actual' => ['number' => '1.0009', 'precision' => 2]],
            65 => ['expected' => '1.00', 'actual' => ['number' => '1.0010', 'precision' => 2]],
            66 => ['expected' => '1.00', 'actual' => ['number' => '1.0020', 'precision' => 2]],
            67 => ['expected' => '1.00', 'actual' => ['number' => '1.0030', 'precision' => 2]],
            68 => ['expected' => '1.00', 'actual' => ['number' => '1.0040', 'precision' => 2]],
            69 => ['expected' => '1.00', 'actual' => ['number' => '1.0041', 'precision' => 2]],
            70 => ['expected' => '1.00', 'actual' => ['number' => '1.0042', 'precision' => 2]],
            71 => ['expected' => '1.00', 'actual' => ['number' => '1.0043', 'precision' => 2]],
            72 => ['expected' => '1.00', 'actual' => ['number' => '1.0044', 'precision' => 2]],
            73 => ['expected' => '1.00', 'actual' => ['number' => '1.0045', 'precision' => 2]],
            74 => ['expected' => '1.00', 'actual' => ['number' => '1.0046', 'precision' => 2]],
            75 => ['expected' => '1.00', 'actual' => ['number' => '1.0047', 'precision' => 2]],
            76 => ['expected' => '1.00', 'actual' => ['number' => '1.0048', 'precision' => 2]],
            77 => ['expected' => '1.00', 'actual' => ['number' => '1.0049', 'precision' => 2]],
            78 => ['expected' => '1.01', 'actual' => ['number' => '1.0050', 'precision' => 2]],
            79 => ['expected' => '1.01', 'actual' => ['number' => '1.0051', 'precision' => 2]],
            80 => ['expected' => '1.01', 'actual' => ['number' => '1.0052', 'precision' => 2]],
            81 => ['expected' => '1.01', 'actual' => ['number' => '1.0053', 'precision' => 2]],
            82 => ['expected' => '1.01', 'actual' => ['number' => '1.0054', 'precision' => 2]],
            83 => ['expected' => '1.01', 'actual' => ['number' => '1.0055', 'precision' => 2]],
            84 => ['expected' => '1.01', 'actual' => ['number' => '1.0056', 'precision' => 2]],
            85 => ['expected' => '1.01', 'actual' => ['number' => '1.0057', 'precision' => 2]],
            86 => ['expected' => '1.01', 'actual' => ['number' => '1.0058', 'precision' => 2]],
            87 => ['expected' => '1.01', 'actual' => ['number' => '1.0060', 'precision' => 2]],
            88 => ['expected' => '1.01', 'actual' => ['number' => '1.0070', 'precision' => 2]],
            89 => ['expected' => '1.01', 'actual' => ['number' => '1.0080', 'precision' => 2]],
            90 => ['expected' => '1.01', 'actual' => ['number' => '1.0090', 'precision' => 2]],
            91 => ['expected' => '1.01', 'actual' => ['number' => '1.0090', 'precision' => 2]],
            92 => ['expected' => '1.01', 'actual' => ['number' => '1.0091', 'precision' => 2]],
            93 => ['expected' => '1.01', 'actual' => ['number' => '1.0092', 'precision' => 2]],
            94 => ['expected' => '1.01', 'actual' => ['number' => '1.0093', 'precision' => 2]],
            95 => ['expected' => '1.01', 'actual' => ['number' => '1.0094', 'precision' => 2]],
            96 => ['expected' => '1.01', 'actual' => ['number' => '1.0095', 'precision' => 2]],
            97 => ['expected' => '1.01', 'actual' => ['number' => '1.0096', 'precision' => 2]],
            98 => ['expected' => '1.01', 'actual' => ['number' => '1.0097', 'precision' => 2]],
            99 => ['expected' => '1.01', 'actual' => ['number' => '1.0098', 'precision' => 2]],
            100 => ['expected' => '1.01', 'actual' => ['number' => '1.0099', 'precision' => 2]],
            101 => ['expected' => '1.01', 'actual' => ['number' => '1.0100', 'precision' => 2]],
            102 => ['expected' => '1.01', 'actual' => ['number' => '1.0101', 'precision' => 2]],

            // BcRound negative...
            103 => ['expected' => '-0.99', 'actual' => ['number' => '-0.9890', 'precision' => 2]],
            104 => ['expected' => -1.0001, 'actual' => ['number' => -1.00009, 'precision' => 4]],
            105 => ['expected' => -1.1, 'actual' => ['number' => -1.09, 'precision' => 1]],

            // BcRound special cases...
            106 => ['expected' => '16.80', 'actual' => ['number' => '16.7983', 'precision' => 2]],
            107 => ['expected' => '15.1261', 'actual' => ['number' => '15.126050', 'precision' => 4]],
            108 => ['expected' => '30.5466', 'actual' => ['number' => '30.546611', 'precision' => 4]],
            109 => ['expected' => number_format(1.95583, 2), 'actual' => ['number' => '1.95583', 'precision' => 2]],
            110 => ['expected' => number_format(5.045, 2), 'actual' => ['number' => '5.045', 'precision' => 2]],
            111 => ['expected' => number_format(5.055, 2), 'actual' => ['number' => '5.055', 'precision' => 2]],
            112 => ['expected' => number_format(9.999, 2), 'actual' => ['number' => '9.999', 'precision' => 2]],
        ];
    }

    /**
     * List of test cases with numbers to be compared with zero.
     *
     */
    private function getCasesForBcCompZero(): array
    {
        return [
            0 => ['expected' => '0', 'actual' => '0.0000'],
            1 => ['expected' => '0', 'actual' => '0.00001'],
            2 => ['expected' => '0', 'actual' => '0.00002'],
            3 => ['expected' => '0', 'actual' => '0.00003'],
            5 => ['expected' => '0', 'actual' => '0.00004'],
            6 => ['expected' => '1', 'actual' => '0.00005'],
            7 => ['expected' => '1', 'actual' => '0.00006'],
            8 => ['expected' => '1', 'actual' => '0.0001'],
            9 => ['expected' => '1', 'actual' => '0.0010'],
            10 => ['expected' => '1', 'actual' => '0.001'],
            11 => ['expected' => '1', 'actual' => '0.0100'],
            12 => ['expected' => '1', 'actual' => '0.010'],
            13 => ['expected' => '1', 'actual' => '0.01'],
            14 => ['expected' => '1', 'actual' => '0.1000'],
            15 => ['expected' => '1', 'actual' => '0.100'],
            16 => ['expected' => '1', 'actual' => '0.10'],
            17 => ['expected' => '1', 'actual' => '0.1'],
            18 => ['expected' => '0', 'actual' => '0.'],
            19 => ['expected' => '0', 'actual' => '0'],
            20 => ['expected' => '0', 'actual' => 0.0],
            21 => ['expected' => '1', 'actual' => 0.01],
            22 => ['expected' => '1', 'actual' => '15.65'],
        ];
    }

    /**
     * List of test cases of float values to be checked and the expected result of the validation whether it is a usable float value.
     *
     */
    private function getCasesForCanBeFloat(): array
    {
        return [
            0 => ['number' => '9987987', 'expected' => true],
            1 => ['number' => '165465', 'expected' => true],
            2 => ['number' => '9', 'expected' => true],
            3 => ['number' => '1', 'expected' => true],
            4 => ['number' => '0', 'expected' => true],
            5 => ['number' => '0.', 'expected' => true],
            6 => ['number' => '0,', 'expected' => false],
            7 => ['number' => '0.0', 'expected' => true],
            8 => ['number' => '0,0', 'expected' => false],
            9 => ['number' => '.0', 'expected' => true],
            10 => ['number' => ',0', 'expected' => false],
            11 => ['number' => '0.0000', 'expected' => true],
            12 => ['number' => '00.00', 'expected' => true],
            13 => ['number' => '.1', 'expected' => true],
            14 => ['number' => ',1', 'expected' => false],
            15 => ['number' => '0.1', 'expected' => true],
            16 => ['number' => '.01', 'expected' => true],
            17 => ['number' => '0.01', 'expected' => true],
            18 => ['number' => '.000000000000000009', 'expected' => true],
            19 => ['number' => '0.000000000000000009', 'expected' => true],
            20 => ['number' => '.000004776546546465', 'expected' => true],
            21 => ['number' => '0.9890', 'expected' => true],
            22 => ['number' => '0,9890', 'expected' => false],
            23 => ['number' => '1.1', 'expected' => true],
            24 => ['number' => '1.0554', 'expected' => true],
            25 => ['number' => '1.05100', 'expected' => true],
            26 => ['number' => '0001.0013800', 'expected' => true],
            27 => ['number' => '15,567.10', 'expected' => false],
            28 => ['number' => '15,567', 'expected' => false],
            29 => ['number' => '15,56', 'expected' => false],
            30 => ['number' => '415,56', 'expected' => false],
            31 => ['number' => '0415,56', 'expected' => false],
        ];
    }
}
