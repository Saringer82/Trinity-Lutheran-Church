<?php

namespace IPLib\Range;

use IPLib\Address\AddressInterface;

/**
 * Interface of all the range types.
 */
interface RangeInterface
{
    /**
     * Get the string representation of this address.
     *
     * @param bool $long set to true to have a long/full representation, false otherwise
     *
     * @return string
     *
     * @example If $long is true, you'll get '0000:0000:0000:0000:0000:0000:0000:0001/128', '::1/128' otherwise.
     */
    public function toString($long = false);

    /**
     * Get the short string representation of this address.
     *
     * @return string
     */
    public function __toString();

    /**
     * Get the type of the IP addresses contained in this range.
     *
     * @return int One of the \IPLib\Address\Type::T_... constants
     */
    public function getAddressType();

    /**
     * Get the type of range of the IP address.
     *
     * @return int One of the \IPLib\Range\Type::T_... constants
     */
    public function getRangeType();

    /**
     * Check if this range contains an IP address.
     *
     * @param \IPLib\Address\AddressInterface $address
     *
     * @return bool
     */
    public function contains(AddressInterface $address);

    /**
     * Check if this range contains another range.
     *
     * @param \IPLib\Range\RangeInterface $range
     *
     * @return bool
     */
    public function containsRange(RangeInterface $range);

    /**
     * Get the initial address contained in this range.
     *
     * @return \IPLib\Address\AddressInterface
     */
    public function getStartAddress();

    /**
     * Get the final address contained in this range.
     *
     * @return \IPLib\Address\AddressInterface
     */
    public function getEndAddress();

    /**
     * Get a string representation of the starting address of this range than can be used when comparing addresses and ranges.
     *
     * @return string
     */
    public function getComparableStartString();

    /**
     * Get a string representation of the final address of this range than can be used when comparing addresses and ranges.
     *
     * @return string
     */
    public function getComparableEndString();

    /**
     * Get the subnet mask representing this range (only for IPv4 ranges).
     *
     * @return \IPLib\Address\IPv4|null return NULL if the range is an IPv6 range, the subnet mask otherwise
     */
    public function getSubnetMask();
}
