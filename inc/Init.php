<?php
/**
 * @package  VentusWEBPlugin
 */
namespace Inc;

final class Init
{
	/**
	 * Store all the classes inside an array
	 * @return array Full list of classes
	 */
	public static function getServices()
	{
		return [
			Pages\Dashboard::class,
			Base\Enqueue::class,
			Base\SettingsLinks::class,
			Base\CustomPostTypeController::class,
/* 			Base\UserProfileController::class, */
/* 			Base\CustomTaxonomyController::class,
			Base\WidgetController::class,
			Base\GalleryController::class,
			Base\TestimonialController::class,
			Base\TemplateController::class,
			Base\AuthController::class,
			Base\MembershipController::class,
			Base\ChatController::class,
			Base\MenuPageController::class, */
			Base\AdminPageController::class,
/* 			Base\CustomClientMenuController::class, */
/* 			MetaBoxes\Inc\MetaboxClass::class, */
/* 			MetaBoxes\Inc\MultiMetaBox::class, */
			MetaBoxes\Inc\MetaboxRegisterFields::class,
			MetaBoxes\Inc\MetaboxScripts::class,
			MetaBoxes\Inc\MetaboxUploader::class,
/* 			MetaBoxes\Classes\lasykesgallery::class */
 
		];
	}

	/**
	 * Loop through the classes, initialize them,
	 * and call the register() method if it exists
	 * @return
	 */
	public static function registerServices()
	{
		foreach (self::getServices() as $class) {
			$service = self::instantiate($class);
			if (method_exists($service, 'register')) {
				$service->register();
			}
		}
	}

	/**
	 * Initialize the class
	 * @param  class $class    class from the services array
	 * @return class instance  new instance of the class
	 */
	private static function instantiate($class)
	{
		$service = new $class();

		return $service;
	}
}


