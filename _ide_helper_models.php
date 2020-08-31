<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models\Lookbooks\Images{
/**
 * App\Models\Lookbooks\Images\LookbookImage
 *
 * @property int $id
 * @property string $name
 * @property string $path
 * @property int $lookbook_id
 * @property int $image_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $url
 * @property-write mixed $raw
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lookbooks\Images\LookbookImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lookbooks\Images\LookbookImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lookbooks\Images\LookbookImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lookbooks\Images\LookbookImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lookbooks\Images\LookbookImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lookbooks\Images\LookbookImage whereImageTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lookbooks\Images\LookbookImage whereLookbookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lookbooks\Images\LookbookImage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lookbooks\Images\LookbookImage wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lookbooks\Images\LookbookImage whereUpdatedAt($value)
 */
	class LookbookImage extends \Eloquent {}
}

namespace App\Models\Lookbooks{
/**
 * Class Lookbook
 *
 * @package App\Models\Lookbooks
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Lookbooks\Images\LookbookImage[] $additional_images
 * @property-read int|null $additional_images_count
 * @property-read mixed $thumbnail
 * @property-read string $upload_directory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Lookbooks\Images\LookbookImage[] $images
 * @property-read int|null $images_count
 * @property-read \App\Models\Lookbooks\Images\LookbookImage $main_image
 * @property-write mixed $raw
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lookbooks\Lookbook newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lookbooks\Lookbook newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lookbooks\Lookbook query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lookbooks\Lookbook whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lookbooks\Lookbook whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lookbooks\Lookbook whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lookbooks\Lookbook whereUpdatedAt($value)
 */
	class Lookbook extends \Eloquent {}
}

namespace App\Models\Orders\DeliveryDetails{
/**
 * Class DeliveryDetail
 *
 * @package App\Models\Orders\DeliveryDetails
 * @property int $id
 * @property string $full_name
 * @property string $phone
 * @property string $city
 * @property string $np_department
 * @property string|null $comment
 * @property string|null $np_delivery_number
 * @property int $order_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-write mixed $raw
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\DeliveryDetails\DeliveryDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\DeliveryDetails\DeliveryDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\DeliveryDetails\DeliveryDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\DeliveryDetails\DeliveryDetail whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\DeliveryDetails\DeliveryDetail whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\DeliveryDetails\DeliveryDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\DeliveryDetails\DeliveryDetail whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\DeliveryDetails\DeliveryDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\DeliveryDetails\DeliveryDetail whereNpDeliveryNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\DeliveryDetails\DeliveryDetail whereNpDepartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\DeliveryDetails\DeliveryDetail whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\DeliveryDetails\DeliveryDetail wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\DeliveryDetails\DeliveryDetail whereUpdatedAt($value)
 */
	class DeliveryDetail extends \Eloquent {}
}

namespace App\Models\Orders{
/**
 * Class Order
 *
 * @package App\Models\Orders
 * @property int $id
 * @property string $name
 * @property int|null $price
 * @property int $order_type_id
 * @property int $status_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Orders\DeliveryDetails\DeliveryDetail $delivery_detail
 * @property-read mixed $created_at_formatted
 * @property-read mixed $created_day
 * @property-read mixed $total_amount
 * @property-read mixed $total_quantity
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Orders\Products\OrderProduct[] $order_products
 * @property-read int|null $order_products_count
 * @property-write mixed $raw
 * @property-read \App\Models\Orders\Statuses\OrderStatus $status
 * @property-read \App\Models\Orders\Types\OrderType $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Order whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Order whereOrderTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Order wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Order whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Order whereUpdatedAt($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Models\Orders\Products{
/**
 * Class OrderProduct
 *
 * @package App\Models\Orders\Products
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $size_id
 * @property int $quantity
 * @property int $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Orders\Order $order
 * @property-read \App\Models\Products\Product $product
 * @property-write mixed $raw
 * @property-read \App\Models\Products\Sizes\Size $size
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Products\OrderProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Products\OrderProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Products\OrderProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Products\OrderProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Products\OrderProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Products\OrderProduct whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Products\OrderProduct wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Products\OrderProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Products\OrderProduct whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Products\OrderProduct whereSizeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Products\OrderProduct whereUpdatedAt($value)
 */
	class OrderProduct extends \Eloquent {}
}

namespace App\Models\Orders\Statuses{
/**
 * App\Models\Orders\Statuses\OrderStatus
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-write mixed $raw
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Statuses\OrderStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Statuses\OrderStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Statuses\OrderStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Statuses\OrderStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Statuses\OrderStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Statuses\OrderStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Statuses\OrderStatus whereUpdatedAt($value)
 */
	class OrderStatus extends \Eloquent {}
}

namespace App\Models\Orders\Types{
/**
 * App\Models\Orders\Types\OrderType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-write mixed $raw
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Types\OrderType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Types\OrderType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Types\OrderType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Types\OrderType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Types\OrderType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Types\OrderType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Orders\Types\OrderType whereUpdatedAt($value)
 */
	class OrderType extends \Eloquent {}
}

namespace App\Models\Other{
/**
 * Class Upload
 *
 * @package App\Models\Other
 * @property int $id
 * @property string $original_name
 * @property string $file_name
 * @property string $path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-write mixed $raw
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Other\Upload newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Other\Upload newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Other\Upload query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Other\Upload whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Other\Upload whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Other\Upload whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Other\Upload whereOriginalName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Other\Upload wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Other\Upload whereUpdatedAt($value)
 */
	class Upload extends \Eloquent {}
}

namespace App\Models\Products\Images{
/**
 * App\Models\Products\Images\ProductImage
 *
 * @property int $id
 * @property string $name
 * @property string $path
 * @property int $product_id
 * @property int $image_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $preview
 * @property-read \Illuminate\Contracts\Routing\UrlGenerator|string $url
 * @property-write mixed $raw
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Images\ProductImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Images\ProductImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Images\ProductImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Images\ProductImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Images\ProductImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Images\ProductImage whereImageTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Images\ProductImage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Images\ProductImage wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Images\ProductImage whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Images\ProductImage whereUpdatedAt($value)
 */
	class ProductImage extends \Eloquent {}
}

namespace App\Models\Products\Images\Types{
/**
 * App\Models\Products\Images\Types\ProductImageType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-write mixed $raw
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Images\Types\ProductImageType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Images\Types\ProductImageType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Images\Types\ProductImageType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Images\Types\ProductImageType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Images\Types\ProductImageType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Images\Types\ProductImageType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Images\Types\ProductImageType whereUpdatedAt($value)
 */
	class ProductImageType extends \Eloquent {}
}

namespace App\Models\Products{
/**
 * Class Product
 *
 * @package App\Models\Products
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string|null $color
 * @property string $price
 * @property string $gender
 * @property string $description
 * @property bool $featured
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Products\Images\ProductImage[] $additional_images
 * @property-read int|null $additional_images_count
 * @property-read mixed $category_name
 * @property-read mixed $stock_total_quantity
 * @property-read string $thumbnail
 * @property-read string $upload_directory
 * @property-read \App\Models\Products\Images\ProductImage $hover_image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Products\Images\ProductImage[] $images
 * @property-read int|null $images_count
 * @property-read \App\Models\Products\Images\ProductImage $main_image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Orders\Order[] $orders
 * @property-read int|null $orders_count
 * @property-write mixed $raw
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Products\Sizes\Size[] $sizes
 * @property-read int|null $sizes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Products\Variations\ProductVariation[] $variations
 * @property-read int|null $variations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Product whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Product whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Product whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Product whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Product whereUpdatedAt($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models\Products\Sizes\SizeGroups{
/**
 * App\Models\Products\Sizes\SizeGroups\SizeGroup
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-write mixed $raw
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Sizes\SizeGroups\SizeGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Sizes\SizeGroups\SizeGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Sizes\SizeGroups\SizeGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Sizes\SizeGroups\SizeGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Sizes\SizeGroups\SizeGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Sizes\SizeGroups\SizeGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Sizes\SizeGroups\SizeGroup whereUpdatedAt($value)
 */
	class SizeGroup extends \Eloquent {}
}

namespace App\Models\Products\Sizes{
/**
 * Class Size
 *
 * @package App\Models\Products\Sizes
 * @property int $id
 * @property int $size_group_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Products\Variations\ProductVariation[] $product_variations
 * @property-read int|null $product_variations_count
 * @property-write mixed $raw
 * @property-read \App\Models\Products\Variations\ProductVariation $specific_product_variation
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Sizes\Size newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Sizes\Size newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Sizes\Size query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Sizes\Size whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Sizes\Size whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Sizes\Size whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Sizes\Size whereSizeGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Sizes\Size whereUpdatedAt($value)
 */
	class Size extends \Eloquent {}
}

namespace App\Models\Products\Variations{
/**
 * Class ProductVariation
 *
 * @package App\Models\Products\Variations
 * @property int $id
 * @property int $product_id
 * @property int $size_id
 * @property int|null $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $size_name
 * @property-write mixed $raw
 * @property-read \App\Models\Products\Sizes\Size $size
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Variations\ProductVariation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Variations\ProductVariation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Variations\ProductVariation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Variations\ProductVariation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Variations\ProductVariation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Variations\ProductVariation whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Variations\ProductVariation whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Variations\ProductVariation whereSizeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products\Variations\ProductVariation whereUpdatedAt($value)
 */
	class ProductVariation extends \Eloquent {}
}

namespace App\Models\Users{
/**
 * App\Models\Users\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-write mixed $raw
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

