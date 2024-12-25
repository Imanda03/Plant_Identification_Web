import {StyleSheet} from 'react-native';
import {useTheme} from '../../src/utils/colors';

export const createStyles = () => {
  const {theme} = useTheme();

  return StyleSheet.create({
    tabBar: {
      position: 'absolute',
      bottom: 10,
      left: 10,
      right: 10,
      elevation: 5,
      backgroundColor: theme.NAVBAR_BACKGROUND,
      borderRadius: 30,
      height: 70,
    },
    tabBarItem: {
      padding: 5,
    },
    // tabBarIcon: {
    //   marginTop: 10,
    // },
    tabLabel: {
      fontSize: 12,
      textAlign: 'center',
      width: 60,
      marginBottom: 10,
    },
    tabBarButtonContainer: {
      flex: 1,
      alignItems: 'center',
    },
    tabBarButton: {
      flexDirection: 'column',
      alignItems: 'center',
      justifyContent: 'center',
      // paddingVertical: 8,
      // paddingHorizontal: 12,
    },
    tabBarButtonActive: {
      backgroundColor: theme.NAVBAR_ACTIVE_BACKGROUND,
      borderRadius: 20,
      marginHorizontal: 10,
    },
  });
};
