import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
	darkMode: 'class',
	content: [
		'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
		'./vendor/laravel/jetstream/**/*.blade.php',
		'./storage/framework/views/*.php',
		'./resources/views/**/*.blade.php',
		"./vendor/robsontenorio/mary/src/View/Components/**/*.php"
	],
	daisyui: {
		themes: ["wireframe", "dracula"],
	},
	theme: {
		fontFamily: {
			sans: ['Raleway', ...defaultTheme.fontFamily.serif],
		},
	},

	plugins: [
		forms,
		typography,
		require("daisyui"),
	],
};
