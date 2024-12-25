import React from 'react';
import {
  ImageBackground,
  View,
  StyleSheet,
  ViewStyle,
  StyleProp,
} from 'react-native';
import {useTheme} from '../../utils/colors';
import {createStyles} from './styles';

interface BackgroundWrapperProps {
  children: React.ReactNode;
  style?: StyleProp<ViewStyle>;
}

const BackgroundWrapper: React.FC<BackgroundWrapperProps> = ({
  children,
  style,
}) => {
  const styles = createStyles();
  return (
    <ImageBackground
      source={require('../../assets/Image/backgroundImage.jpg')}
      style={[styles.imageBackground, style]}>
      <View style={styles.overlay} />
      <View>{children}</View>
    </ImageBackground>
  );
};

export default BackgroundWrapper;
