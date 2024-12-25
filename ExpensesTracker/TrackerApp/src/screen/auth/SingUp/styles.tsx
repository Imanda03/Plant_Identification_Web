import {StyleSheet} from 'react-native';
import {useTheme} from '../../../utils/colors';

export const createStyles = () => {
  const {theme} = useTheme();

  return StyleSheet.create({
    scrollContent: {
      paddingBottom: 40,
    },

    title: {
      color: theme.TEXT,
      fontWeight: '800',
      fontSize: 20,
      textAlign: 'center',
      marginBottom: 5,
      marginTop: 5,
    },
    loginField: {
      marginTop: 15,
      gap: 10,
    },
    forgotPassword: {
      flexDirection: 'row',
      justifyContent: 'flex-end',
    },
    forgetText: {
      color: theme.TEXT,
      fontWeight: '700',
      textAlign: 'left',
    },
    errorMessage: {
      color: theme.ERROR,
      textAlign: 'center',
      fontWeight: '600',
    },
  });
};
