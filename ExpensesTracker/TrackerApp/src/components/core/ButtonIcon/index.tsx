import {View, Text, TouchableOpacity} from 'react-native';
import React from 'react';
import {createStyles} from './styles';
import {EntypoIcon, IoniconsIcon} from '../../../utils/Icon';
import {useTheme} from '../../../utils/colors';

interface ButtonProps {
  title: string;
  onPress: () => void;
  iconName?: string;
  marginTop?: number;
}

const ButtonIconComponent = ({
  title,
  onPress,
  iconName,
  marginTop,
}: ButtonProps) => {
  const styles = createStyles(iconName);
  const {theme} = useTheme();
  return (
    <TouchableOpacity
      style={[styles.container, {marginTop: marginTop ?? 0}]}
      activeOpacity={0.7}
      onPress={onPress}>
      {iconName && <View></View>}
      <Text style={styles.text}>{title}</Text>
      {iconName && (
        <EntypoIcon
          name={iconName}
          color={theme.SECONDARY}
          size={30}
          style={styles.icon}
        />
      )}
    </TouchableOpacity>
  );
};

export default ButtonIconComponent;
