import {useContext} from 'react';
import {ThemeContext, ThemeOptions} from '../context/ThemeProvider';

export const COLORS = {
  primary: '#1A1A1A',
  secondary: '#FCFCFC',
  purple: '#723FEB',
} as const;

const common = {
  WARNING: '#FFC107',
  ERROR: '#F44336',
  SUCCESS: '#4CAF50',
  PURPLE: '#723FEB',
  PRIMARY: '#1A1A1A',
  SECONDARY: '#FCFCFC',
} as const;

export interface ThemeColors {
  SECONDARY: string;
  PRIMARY: string;
  BACKGROUND: string;
  TEXT: string;
  WARNING: string;
  ERROR: string;
  SUCCESS: string;
  PURPLE: string;
  SHADOW: string;
  SHADOW_OPACITY: number;
  INPUT_BACKGROUND: string;
  PLACEHOLDER_COLOR: string;
  BORDER_COLOR: string;
  NAVBAR_BACKGROUND: string;
  NAVBAR_ACTIVE_BACKGROUND: string;
  NAVBAR_ACTIVE_TEXT: string;
  NAVBAR_INACTIVE_TEXT: string;
}

const lightTheme: ThemeColors = {
  ...common,
  BACKGROUND: COLORS.secondary,
  TEXT: COLORS.primary,
  SHADOW: 'rgba(223, 220, 220, 0.2)',
  SHADOW_OPACITY: 0.2,
  INPUT_BACKGROUND: '#F5F5F5',
  PLACEHOLDER_COLOR: 'rgba(0, 0, 0, 0.4)',
  BORDER_COLOR: '#DADADA',
  NAVBAR_BACKGROUND: '#232e23',
  NAVBAR_ACTIVE_BACKGROUND: '#777a77',
  NAVBAR_ACTIVE_TEXT: '#ffffff',
  NAVBAR_INACTIVE_TEXT: '#dcdedc',
};

const darkTheme: ThemeColors = {
  ...common,
  BACKGROUND: COLORS.primary,
  TEXT: COLORS.secondary,
  SHADOW: 'rgba(255, 255, 255, 0.1)',
  SHADOW_OPACITY: 0.1,
  INPUT_BACKGROUND: '#2C2C2C',
  PLACEHOLDER_COLOR: 'rgba(255, 255, 255, 0.5)',
  BORDER_COLOR: '#3A3A3A',

  NAVBAR_BACKGROUND: '#f5f7f5',
  NAVBAR_ACTIVE_BACKGROUND: '#e0e3e0',
  NAVBAR_ACTIVE_TEXT: '#232323',
  NAVBAR_INACTIVE_TEXT: '#757575',
};

interface UseThemeReturn {
  theme: ThemeColors;
  setTheme: React.Dispatch<React.SetStateAction<ThemeOptions>>;
}

export const useTheme = (): UseThemeReturn => {
  const context = useContext(ThemeContext);

  if (context === undefined) {
    throw new Error(
      'useTheme must be used within a ThemeProvider. ' +
        'Wrap a parent component in <ThemeProvider> to fix this error.',
    );
  }

  return {
    theme: context.theme === 'dark' ? darkTheme : lightTheme,
    setTheme: context.setTheme,
  };
};
