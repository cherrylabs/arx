<?php
require_once realpath(dirname(__FILE__)) . '/../TestHelper.php';

class Braintree_SubscriptionSearchTest extends PHPUnit_Framework_TestCase
{
    public function testSearch_billingCyclesRemaining_isRangeNode()
    {
        $node = Braintree_SubscriptionSearch::billingCyclesRemaining();
        $this->assertType('Braintree_RangeNode', $node);
    }

    public function testSearch_price_isRangeNode()
    {
        $node = Braintree_SubscriptionSearch::price();
        $this->assertType('Braintree_RangeNode', $node);
    }

    public function testSearch_daysPastDue_isRangeNode()
    {
        $node = Braintree_SubscriptionSearch::daysPastDue();
        $this->assertType('Braintree_RangeNode', $node);
    }

    public function testSearch_id_isTextNode()
    {
        $node = Braintree_SubscriptionSearch::id();
        $this->assertType('Braintree_TextNode', $node);
    }

    public function testSearch_ids_isMultipleValueNode()
    {
        $node = Braintree_SubscriptionSearch::ids();
        $this->assertType('Braintree_MultipleValueNode', $node);
    }

    public function testSearch_inTrialPeriod_isMultipleValueNode()
    {
        $node = Braintree_SubscriptionSearch::inTrialPeriod();
        $this->assertType('Braintree_MultipleValueNode', $node);
    }

    public function testSearch_merchantAccountId_isMultipleValueNode()
    {
        $node = Braintree_SubscriptionSearch::merchantAccountId();
        $this->assertType('Braintree_MultipleValueNode', $node);
    }

    public function testSearch_planId_isMultipleValueOrTextNode()
    {
        $node = Braintree_SubscriptionSearch::planId();
        $this->assertType('Braintree_MultipleValueOrTextNode', $node);
    }

    public function testSearch_status_isMultipleValueNode()
    {
        $node = Braintree_SubscriptionSearch::status();
        $this->assertType('Braintree_MultipleValueNode', $node);
    }
}
