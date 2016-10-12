<?php

/**
 * Created by PhpStorm.
 * User: dai_duong
 * Date: 9/20/2016
 * Time: 11:41 AM
 */
class Contract_transfer_campaignTest extends \Ci_Framework_TestCase
{
    /**
     * check valid cash back
     * @dataProvider cash_back_amount_data_provider
     */
    public function test_cash_back_amount ($data) {
        foreach ($data as $item) {
            $result = $this->CI->contract_transfer_campaign->valid_cash_back_amount($item['amount']);
            $this->assertEquals($item['status'], $result);
        }
    }
    public function cash_back_amount_data_provider () {
        return array(
                    array (
                        array(
                            array(
                                    'amount' => '',
                                    'status' => false,
                            ),
                            array(
                                    'amount' => 'abc',
                                    'status' => false,
                            ),
                            array(
                                    'amount' => '242,210',
                                    'status' => '242210',
                            ),
                            array(
                                    'amount' => '1,242,210',
                                    'status' => '1242210',
                            ),
                            array(
                                    'amount' => '2.242.184',
                                    'status' => '2242184',
                            ),
                            array(
                                    'amount' => '1242,210',
                                    'status' => false,
                            ),
                            array(
                                    'amount' => '2242.184',
                                    'status' => false,
                            ),
                            array(
                                    'amount' => '1,242210',
                                    'status' => false,
                            ),
                            array(
                                    'amount' => '2.242184',
                                    'status' => false,
                                ),
                            array(
                                    'amount' => '2.242,184',
                                    'status' => false,
                            ),
                            array(
                                    'amount' => '242.184',
                                    'status' => '242184',
                            ),
                            array(
                                    'amount' => '24.21.84',
                                    'status' => false,
                            ),
                            array(
                                    'amount' => '2.4.2.1.8.4',
                                    'status' => false,
                            ),
                            array(
                                    'amount' => '1,000,000',
                                    'status' => '1000000',
                            ),
                            array(
                                    'amount' => '1,00,00,00',
                                    'status' => false,
                            ),
                            array(
                                    'amount' => '1,0,0,0,0,0,0',
                                    'status' => false,
                            ),
                        ),
                    )
        );
    }

    /**
     * check valid date
     * @dataProvider cash_back_date_data_provider
     */
    public function test_cash_back_date ($data) {
        foreach ($data as $item) {
            $result = $this->CI->contract_transfer_campaign->valid_cash_back_date($item['date']);
            $this->assertEquals($item['status'], $result);
        }
    }
    public function cash_back_date_data_provider () {
        return array(
            array (
                array(
                    array(
                            'date'   => '',
                            'status' => false,
                    ),
                    array(
                            'date'   => 'abc',
                            'status' => false,
                    ),
                    array(
                            'date'   => '1234',
                            'status' => false,
                    ),
                    array(
                            'date'   => '123456',
                            'status' => false,
                    ),
                    array(
                            'date'   => '2016-10-20',
                            'status' => '2016-10-20',
                    ),
                    array(
                            'date' => '2016-02-30',
                            'status' => false,
                    ),
                    array(
                            'date' => '2016/10/20',
                            'status' => '2016-10-20',
                    ),
                    array(
                            'date' => '16/02/30',
                            'status' => false,
                    ),
                    array(
                            'date' => '16:10:20',
                            'status' => '2016-10-20',
                    ),
                    array(
                            'date' => '16:02:30',
                            'status' => false,
                    ),
                    array(
                            'date' => '16-10-20',
                            'status' => '2016-10-20',
                    ),
                    array(
                            'date' => '16-02-30',
                            'status' => false,
                    ),
                    array(
                            'date' => '16/10/20',
                            'status' => '2016-10-20',
                    ),
                    array(
                            'date' => '16/02/30',
                            'status' => false,
                    ),
                    array(
                            'date' => '16:10:20',
                            'status' => '2016-10-20',
                    ),
                    array(
                            'date' => '16:02:30',
                            'status' => false,
                    ),
                    array(
                            'date' => '161020',
                            'status' => '2016-10-20',
                    ),
                    array(
                            'date' => '160230',
                            'status' => false,
                    ),
                    array(
                            'date' => '20161020',
                            'status' => '2016-10-20',
                    ),
                    array(
                            'date' => '20160230',
                            'status' => false,
                    ),
                ),
            )
        );
    }

    /**
     * test sort
     * @dataProvider sort_data_provider
     */
    public function test_sort_table_base_on_column ($data) {
        $expected_result1 = array(
                array(
                    'cash_back_date' => '2016-10-07'
                ),
                array(
                    'cash_back_date' => '2016-10-09'
                ),
                array(
                    'cash_back_date' => '2016-10-11'
                ),
                array(
                    'cash_back_date' => '2016-10-13'
                ),
            );
        $result1 = $this->CI->contract_transfer_campaign->sort_table_base_on_column($data, 'cash_back_date');
        $this->assertEquals($expected_result1, $result1);

        $expected_result2 = array(
                array(
                        'cash_back_date' => '2016-10-13'
                ),
                array(
                        'cash_back_date' => '2016-10-11'
                ),
                array(
                        'cash_back_date' => '2016-10-09'
                ),
                array(
                        'cash_back_date' => '2016-10-07'
                ),
        );
        $result2 = $this->CI->contract_transfer_campaign->sort_table_base_on_column($data, 'cash_back_date', 'DESC');
        $this->assertEquals($expected_result2, $result2);
    }
    public function sort_data_provider () {
        return array(
            array(
                array(
                    array(
                            'cash_back_date' => '2016-10-11'
                    ),
                    array(
                            'cash_back_date' => '2016-10-09'
                    ),
                    array(
                            'cash_back_date' => '2016-10-13'
                    ),
                    array(
                            'cash_back_date' => '2016-10-07'
                    )
                )
            )
        );
    }

    /**
     * check insert
     * @dataProvider contract_transfer_campaign_data_provider
     */
    public function test_insert_contract_transfer_campaign_by_contract_id ($data) {
        $result = $this->CI->contract_transfer_campaign->_insert_contract_transfer_campaign_by_contract_id($data);
        $this->assertTrue($result);
    }
    public function contract_transfer_campaign_data_provider () {
        return array(
                    array (
                        array(
                                'contract_id'       => '242099',
                                'cash_back_amount'  => '10000',
                                'cash_back_date'    => '2016/10/11',
                        ),
                    )
                );
    }

    /**
     * check update
     * @dataProvider update_contract_transfer_campaign_data_provider
     */
    public function test_update_contract_transfer_campaign ($data) {
        $result = $this->CI->contract_transfer_campaign->_update_contract_transfer_campaign_by_contract_id($data);
        $this->assertTrue($result);
    }

    public function update_contract_transfer_campaign_data_provider () {
        return array(
            array (
                array(
                        'contract_id'       => '242099',
                        'cash_back_amount'  => '20000',
                        'cash_back_date'    => '2017/10/11',
                ),
            )
        );
    }


}
