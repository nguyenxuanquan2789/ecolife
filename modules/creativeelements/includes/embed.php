<?php
/**
 * Creative Elements - Elementor based PageBuilder [in-stock]
 *
 * @author    WebshopWorks, Elementor
 * @copyright 2019-2021 WebshopWorks.com & Elementor.com
 * @license   https://www.gnu.org/licenses/gpl-3.0.html
 */

namespace CE;

defined('_PS_VERSION_') or die;

class Embed
{
    private static $provider_match_masks = array(
        'youtube' => '/^(?:https?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?vi?=|(?:embed|v|vi|user)\/))([^\?&\"\'>]+)/',
        'vimeo' => '/(?:https?:\/\/)?(?:www\.)?(?:player\.)?vimeo\.com\/(?:[a-z]*\/)*([‌​0-9]{6,11})[?]?.*/',
    );

    private static $embed_patterns = array(
        'youtube' => 'https://www.youtube.com/embed/{VIDEO_ID}?feature=oembed',
        'vimeo' => 'https://player.vimeo.com/video/{VIDEO_ID}',
    );

    public static function getVideoProperties($video_url)
    {
        foreach (self::$provider_match_masks as $provider => $match_mask) {
            preg_match($match_mask, $video_url, $matches);

            if ($matches) {
                return array(
                    'provider' => $provider,
                    'video_id' => $matches[1],
                );
            }
        }

        return null;
    }

    public static function getEmbedUrl($video_url, array $embed_url_params = array())
    {
        $video_properties = self::getVideoProperties($video_url);

        if (!$video_properties) {
            return null;
        }

        $embed_pattern = self::$embed_patterns[$video_properties['provider']];

        $embed_pattern = str_replace('{VIDEO_ID}', $video_properties['video_id'], $embed_pattern);

        return add_query_arg($embed_url_params, $embed_pattern);
    }

    public static function getEmbedHtml($video_url, array $embed_url_params = array(), array $frame_attributes = array())
    {
        $video_embed_url = self::getEmbedUrl($video_url, $embed_url_params);

        if (!$video_embed_url) {
            return null;
        }

        $default_frame_attributes = array(
            'src' => $video_embed_url,
            'allowfullscreen',
        );

        $frame_attributes = array_merge($default_frame_attributes, $frame_attributes);

        $attributes_for_print = array();

        foreach ($frame_attributes as $attribute_key => $attribute_value) {
            $attribute_value = esc_attr($attribute_value);

            if (is_numeric($attribute_key)) {
                $attributes_for_print[] = $attribute_value;
            } else {
                $attributes_for_print[] = sprintf('%s="%s"', $attribute_key, $attribute_value);
            }
        }

        $attributes_for_print = implode(' ', $attributes_for_print);

        $frame_html = "<\x69frame $attributes_for_print></\x69frame>";

        return apply_filters('oembed_result', $frame_html, $video_url, $frame_attributes);
    }
}
