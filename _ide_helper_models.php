<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Article
 *
 * @property int $id
 * @property int|null $article_type_id
 * @property int|null $user_id The main author of the article
 * @property string $title
 * @property string|null $intro
 * @property string|null $content
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string $slug
 * @property string|null $baseline
 * @property string|null $cover_image
 * @property string|null $cover_image_title
 * @property string|null $cover_image_alt
 * @property string|null $cover_video Youtube or Vimeo video ID or URL
 * @property int $is_published If not published, only visible to author
 * @property string|null $published_from If set, article will be published after this date
 * @property string|null $published_until If set, article will be unpublished after this date
 * @property int|null $published_by_user_id The user who actually published the article
 * @property int $is_private Not displayed in lists, available only to logged in users
 * @property int $is_secret Not displayed in lists, available only by direct link
 * @property int $is_archived
 * @property int $is_featured Displayed highlighted in list
 * @property int $is_pinned Displayed on top of the list
 * @property int $is_hero Displayed in big format on top of the list
 * @property int $views_count
 * @property int $likes_count
 * @property int $dislikes_count
 * @property int $comments_count
 * @property int $sort_order Used for sorting in lists, if the lists have custom sorting set
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ArticleCategory> $categories
 * @property-read int|null $categories_count
 * @property-read \App\Models\ArticleType|null $type
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\ArticleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereArticleTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereBaseline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCommentsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCoverImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCoverImageAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCoverImageTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCoverVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereDislikesCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereIntro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereIsArchived($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereIsFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereIsHero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereIsPinned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereIsPrivate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereIsSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereLikesCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article wherePublishedByUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article wherePublishedFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article wherePublishedUntil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereViewsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Article withoutTrashed()
 */
	class Article extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ArticleCategory
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property string|null $description
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string $slug
 * @property string|null $baseline
 * @property string|null $cover_image
 * @property string|null $cover_image_title
 * @property string|null $cover_image_alt
 * @property int $views_count
 * @property int $sort_order Used for sorting in menus, if the menus have custom sorting set
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Article> $articles
 * @property-read int|null $articles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ArticleCategory> $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ArticleCategory> $descendants
 * @property-read int|null $descendants_count
 * @property-read ArticleCategory|null $parent
 * @method static \Database\Factories\ArticleCategoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory whereBaseline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory whereCoverImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory whereCoverImageAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory whereCoverImageTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory whereViewsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory withoutTrashed()
 */
	class ArticleCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ArticlePhotoGallery
 *
 * @property int $id
 * @property int|null $user_id The user who created the gallery
 * @property string $name
 * @property string|null $description
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string $slug
 * @property string|null $baseline
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ArticlePhotoGalleryImage> $images
 * @property-read int|null $images_count
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\ArticlePhotoGalleryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlePhotoGallery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlePhotoGallery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlePhotoGallery query()
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlePhotoGallery whereBaseline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlePhotoGallery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlePhotoGallery whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlePhotoGallery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlePhotoGallery whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlePhotoGallery whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlePhotoGallery whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlePhotoGallery whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlePhotoGallery whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlePhotoGallery whereUserId($value)
 */
	class ArticlePhotoGallery extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ArticlePhotoGalleryImage
 *
 * @property int $id
 * @property int|null $user_id The user who uploaded the image
 * @property string $file
 * @property string|null $title
 * @property string|null $alt
 * @property int $sort_order Used for sorting in galleries, if the galleries have custom sorting set
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ArticlePhotoGallery> $galleries
 * @property-read int|null $galleries_count
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\ArticlePhotoGalleryImageFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlePhotoGalleryImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlePhotoGalleryImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlePhotoGalleryImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlePhotoGalleryImage whereAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlePhotoGalleryImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlePhotoGalleryImage whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlePhotoGalleryImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlePhotoGalleryImage whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlePhotoGalleryImage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlePhotoGalleryImage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticlePhotoGalleryImage whereUserId($value)
 */
	class ArticlePhotoGalleryImage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ArticleType
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Article> $articles
 * @property-read int|null $articles_count
 * @method static \Database\Factories\ArticleTypeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleType query()
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleType whereUpdatedAt($value)
 */
	class ArticleType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Contact
 *
 * @property int $id
 * @property string $from_name
 * @property string $from_email
 * @property string $subject
 * @property string $message
 * @property string|null $headers
 * @property string|null $attachments
 * @property string $ipv4
 * @property int $is_read
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereAttachments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereFromEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereFromName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereHeaders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereIpv4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact withoutTrashed()
 */
	class Contact extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ContactFieldType
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string|null $icon
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContactForm> $fields
 * @property-read int|null $fields_count
 * @method static \Illuminate\Database\Eloquent\Builder|ContactFieldType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactFieldType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactFieldType query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactFieldType whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactFieldType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactFieldType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactFieldType whereType($value)
 */
	class ContactFieldType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ContactForm
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $name_as_placeholder
 * @property string|null $description
 * @property string|null $notes
 * @property int $contact_field_type_id
 * @property int $required
 * @property int $max_length
 * @property string|null $extensions
 * @property array|null $input_options
 * @property int $columns
 * @property int $active
 * @property int $sort_order
 * @property-read \App\Models\ContactFieldType $type
 * @method static \Illuminate\Database\Eloquent\Builder|ContactForm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactForm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactForm query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactForm whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactForm whereColumns($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactForm whereContactFieldTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactForm whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactForm whereExtensions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactForm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactForm whereInputOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactForm whereMaxLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactForm whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactForm whereNameAsPlaceholder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactForm whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactForm whereRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactForm whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactForm whereSortOrder($value)
 */
	class ContactForm extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ContactOption
 *
 * @property int $id
 * @property int $contact_option_type_id
 * @property string $value
 * @property string|null $latitude
 * @property string|null $longitude
 * @property int $active
 * @property int $sort_order
 * @property-read \App\Models\ContactOptionType $type
 * @method static \Illuminate\Database\Eloquent\Builder|ContactOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactOption whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactOption whereContactOptionTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactOption whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactOption whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactOption whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactOption whereValue($value)
 */
	class ContactOption extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ContactOptionType
 *
 * @property int $id
 * @property string $name
 * @property string|null $icon
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContactOption> $options
 * @property-read int|null $options_count
 * @method static \Illuminate\Database\Eloquent\Builder|ContactOptionType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactOptionType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactOptionType query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactOptionType whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactOptionType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactOptionType whereName($value)
 */
	class ContactOptionType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Settings
 *
 * @property int $id
 * @property string $group
 * @property string $key
 * @property string|null $value
 * @property string|null $comments
 * @method static \Illuminate\Database\Eloquent\Builder|Settings isMailer(string $group)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings query()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereValue($value)
 */
	class Settings extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ArticlePhotoGallery> $articlePhotoGalleries
 * @property-read int|null $article_photo_galleries_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ArticlePhotoGalleryImage> $articlePhotoGalleryImages
 * @property-read int|null $article_photo_gallery_images_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Article> $articles
 * @property-read int|null $articles_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

