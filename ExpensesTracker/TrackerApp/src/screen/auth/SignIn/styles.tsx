import {StyleSheet} from 'react-native';
import {useTheme} from '../../../utils/colors';

export const createStyles = () => {
  const {theme} = useTheme();

  return StyleSheet.create({
    title: {
      color: theme.TEXT,
      fontWeight: '800',
      fontSize: 24,
      textAlign: 'center',
    },
    imageContainer: {
      alignItems: 'center',
      top: '-6%',
    },
    shadowContainer: {
      top: '10%',
      position: 'absolute',
      width: '85%',
      height: '45%',
      backgroundColor: theme.SHADOW,
      borderRadius: 100,
      bottom: -10,
      shadowColor: '#000',
      shadowOffset: {width: 0, height: 5},
      shadowOpacity: theme.SHADOW_OPACITY,
      shadowRadius: 10,
      elevation: 5,
    },
    image: {
      // top: '-5%',
      width: '65%',
      height: '65%',
    },
    loginField: {
      top: '-32%',
    },
    forgotPassword: {
      marginTop: 10,
      flexDirection: 'row',
      justifyContent: 'space-between',
    },
    forgetText: {
      color: theme.TEXT,
      width: '100%',
      fontWeight: '700',
    },
  });
};
