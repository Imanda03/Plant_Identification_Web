import {StyleSheet} from 'react-native';
import {useTheme} from '../../utils/colors';

export const createStyles = () => {
  const {theme} = useTheme();
  return StyleSheet.create({
    imageBackground: {
      flex: 1,
      // justifyContent: 'center',
      // alignItems: 'center',
      paddingHorizontal: 20,
    },

    overlay: {
      position: 'absolute',
      top: 0,
      left: 0,
      right: 0,
      bottom: 0,
      backgroundColor: theme.BACKGROUND,
      opacity: 0.9,
    },
  });
};
