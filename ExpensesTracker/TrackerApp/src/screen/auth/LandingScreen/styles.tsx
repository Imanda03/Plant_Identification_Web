import {StyleSheet} from 'react-native';
import {useTheme} from '../../../utils/colors';

export const createStyles = () => {
  const {theme} = useTheme();

  return StyleSheet.create({
    image: {
      width: '90%',
      height: '40%',
      marginTop: 30,
      alignSelf: 'center',
      justifyContent: 'center',
    },

    textContainer: {
      flexDirection: 'row',
      alignSelf: 'center',
    },
    text: {
      color: theme.TEXT,
      fontSize: 36,
      fontWeight: '300',
    },
    textDescription: {
      alignSelf: 'center',
      fontSize: 12,
      textAlign: 'center',
      fontWeight: '300',
      color: theme.TEXT,
      marginTop: 15,
    },
    ButtonContainer: {
      marginTop: '40%',
      justifyContent: 'center',
      flexDirection: 'column',
      gap: 20,
    },
    Button: {
      backgroundColor: theme.PURPLE,
      flexDirection: 'row',
      alignItems: 'center',
      justifyContent: 'center',
      height: 50,
      borderRadius: 20,
    },
    buttonText: {
      color: theme.SECONDARY,
      padding: 10,
      fontSize: 20,
      fontWeight: '700',
    },
  });
};
