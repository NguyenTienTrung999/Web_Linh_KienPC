import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import containerQueries from '@tailwindcss/container-queries';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            borderRadius: {
                "DEFAULT": "0.125rem",
                "lg": "0.25rem",
                "xl": "0.5rem",
                "full": "0.75rem"
            },
            fontFamily: {
                "display": ["Inter", "sans-serif"]
            },
            colors: {
                "primary": "#2badee",
                "background-light": "#f6f7f8",
                "background-dark": "#101c22",
                "on-secondary-fixed-variant": "#b45309",
                "secondary": "#f39c12",
                "error-container": "#fef2f2",
                "surface-container": "#ffffff",
                "on-tertiary-fixed-variant": "#b91c1c",
                "surface-tint": "#2badee",
                "on-primary-container": "#0369a1",
                "surface-container-lowest": "#ffffff",
                "surface-container-high": "#f1f5f9",
                "on-primary": "#ffffff",
                "on-primary-fixed-variant": "#0369a1",
                "outline-variant": "#e2e8f0",
                "on-surface": "#0f172a",
                "secondary-fixed-dim": "#fbbf24",
                "inverse-surface": "#1e293b",
                "on-tertiary": "#ffffff",
                "on-secondary-fixed": "#78350f",
                "on-error": "#ffffff",
                "surface-container-highest": "#e2e8f0",
                "outline": "#cbd5e1",
                "on-background": "#0f172a",
                "secondary-fixed": "#fde68a",
                "on-secondary-container": "#b45309",
                "secondary-container": "#fef3c7",
                "on-error-container": "#991b1b",
                "tertiary-fixed-dim": "#f87171",
                "primary-fixed-dim": "#7dd3fc",
                "surface-variant": "#f1f5f9",
                "tertiary-container": "#fee2e2",
                "error": "#dc2626",
                "surface-bright": "#ffffff",
                "on-tertiary-container": "#991b1b",
                "on-tertiary-fixed": "#7f1d1d",
                "background": "#f6f7f8",
                "tertiary-fixed": "#fecaca",
                "surface-dim": "#d6dae0",
                "tertiary": "#ef4444",
                "surface-container-low": "#f6f7f8",
                "surface": "#f6f7f8",
                "primary-container": "#e0f2fe",
                "inverse-primary": "#7dd3fc",
                "primary-fixed": "#bae6fd",
                "on-primary-fixed": "#0c4a6e",
                "on-surface-variant": "#475569",
                "on-secondary": "#ffffff",
                "inverse-on-surface": "#f8fafc",
                // Keeping original tech colors just in case they are used in other pages
                tech: {
                    dark: '#09090b',
                    card: '#18181b',
                    border: '#27272a',
                    primary: '#ef4444',
                    primaryHover: '#dc2626',
                    accent: '#38bdf8',
                    text: '#fafafa',
                    muted: '#a1a1aa',
                }
            },
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                display: ["Inter", "sans-serif"],
                outfit: ['Outfit', 'sans-serif'],
            },
            borderRadius: {
                "DEFAULT": "0.125rem",
                "lg": "0.25rem",
                "xl": "0.5rem",
                "full": "0.75rem"
            },
            animation: {
                'fade-in': 'fadeIn 0.5s ease-out forwards',
                'slide-up': 'slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideUp: {
                    '0%': { opacity: '0', transform: 'translateY(30px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                }
            }
        },
    },

    plugins: [forms, containerQueries],
};
